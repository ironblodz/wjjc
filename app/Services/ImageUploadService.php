<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageUploadService
{
    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    private const MAX_FILE_SIZE = 5120; // 5MB em KB
    private const MAX_DIMENSIONS = 4000; // Máximo de 4000px
    private const QUALITY = 85; // Qualidade de compressão

    /**
     * Upload e otimiza uma imagem
     */
    public function uploadImage(UploadedFile $file, string $directory = 'photos'): array
    {
        try {
            // Validações básicas
            $this->validateFile($file);

            // Gera nome único para o arquivo
            $fileName = $this->generateFileName($file);
            $filePath = $directory . '/' . $fileName;

            // Processa e otimiza a imagem
            $optimizedImage = $this->processImage($file);

            // Salva no storage
            $fullPath = Storage::disk('public')->put($filePath, $optimizedImage);

            if (!$fullPath) {
                throw new \Exception('Falha ao salvar a imagem no storage');
            }

            // Log do upload bem-sucedido
            Log::info('Imagem enviada com sucesso', [
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);

            return [
                'success' => true,
                'path' => $filePath,
                'filename' => $fileName,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ];

        } catch (\Exception $e) {
            Log::error('Erro no upload de imagem', [
                'original_name' => $file->getClientOriginalName(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Upload múltiplas imagens
     */
    public function uploadMultipleImages(array $files, string $directory = 'photos'): array
    {
        $results = [];
        $errors = [];

        foreach ($files as $index => $file) {
            $result = $this->uploadImage($file, $directory);

            if ($result['success']) {
                $results[] = $result;
            } else {
                $errors[] = [
                    'index' => $index,
                    'original_name' => $file->getClientOriginalName(),
                    'error' => $result['error']
                ];
            }
        }

        return [
            'success' => empty($errors),
            'uploaded' => $results,
            'errors' => $errors
        ];
    }

    /**
     * Remove uma imagem do storage
     */
    public function deleteImage(string $filePath): bool
    {
        try {
            if (Storage::disk('public')->exists($filePath)) {
                $deleted = Storage::disk('public')->delete($filePath);

                if ($deleted) {
                    Log::info('Imagem removida com sucesso', ['file_path' => $filePath]);
                    return true;
                }
            }

            Log::warning('Tentativa de remover imagem inexistente', ['file_path' => $filePath]);
            return false;

        } catch (\Exception $e) {
            Log::error('Erro ao remover imagem', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Valida o arquivo de imagem
     */
    private function validateFile(UploadedFile $file): void
    {
        // Verifica se é um arquivo válido
        if (!$file->isValid()) {
            throw new \Exception('Arquivo inválido ou corrompido');
        }

        // Verifica o tipo MIME
        if (!in_array($file->getMimeType(), self::ALLOWED_MIMES)) {
            throw new \Exception('Tipo de arquivo não permitido. Use apenas: JPEG, PNG, GIF ou WEBP');
        }

        // Verifica o tamanho
        if ($file->getSize() > (self::MAX_FILE_SIZE * 1024)) {
            throw new \Exception('Arquivo muito grande. Tamanho máximo: ' . self::MAX_FILE_SIZE . 'KB');
        }

        // Verifica se é realmente uma imagem
        if (!getimagesize($file->getPathname())) {
            throw new \Exception('Arquivo não é uma imagem válida');
        }
    }

    /**
     * Gera nome único para o arquivo
     */
    private function generateFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('Y-m-d_H-i-s');
        $random = Str::random(8);

        return "img_{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Processa e otimiza a imagem
     */
    private function processImage(UploadedFile $file): string
    {
        $image = Image::make($file->getPathname());

        // Redimensiona se necessário
        if ($image->width() > self::MAX_DIMENSIONS || $image->height() > self::MAX_DIMENSIONS) {
            $image->resize(self::MAX_DIMENSIONS, self::MAX_DIMENSIONS, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Otimiza a qualidade
        $image->encode($file->getClientOriginalExtension(), self::QUALITY);

        return $image->stream();
    }

    /**
     * Verifica se uma imagem existe no storage
     */
    public function imageExists(string $filePath): bool
    {
        return Storage::disk('public')->exists($filePath);
    }

    /**
     * Obtém informações de uma imagem
     */
    public function getImageInfo(string $filePath): ?array
    {
        try {
            if (!$this->imageExists($filePath)) {
                return null;
            }

            // Usar o conteúdo do arquivo para obter informações
            $fileContent = Storage::disk('public')->get($filePath);
            $imageInfo = getimagesizefromstring($fileContent);

            return [
                'width' => $imageInfo[0] ?? 0,
                'height' => $imageInfo[1] ?? 0,
                'mime_type' => $imageInfo['mime'] ?? '',
                'file_size' => Storage::disk('public')->size($filePath),
                'last_modified' => Storage::disk('public')->lastModified($filePath)
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao obter informações da imagem', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Limpa imagens órfãs (não referenciadas no banco)
     */
    public function cleanupOrphanedImages(): array
    {
        try {
            $orphanedFiles = [];
            $deletedCount = 0;

            // Lista todas as imagens no storage
            $files = Storage::disk('public')->allFiles('photos');

            foreach ($files as $file) {
                // Verifica se a imagem está referenciada no banco
                $isReferenced = \App\Models\Photo::where('image_path', $file)->exists() ||
                               \App\Models\PhotoImage::where('image_path', $file)->exists();

                if (!$isReferenced) {
                    $orphanedFiles[] = $file;

                    if ($this->deleteImage($file)) {
                        $deletedCount++;
                    }
                }
            }

            Log::info('Limpeza de imagens órfãs concluída', [
                'total_orphaned' => count($orphanedFiles),
                'deleted_count' => $deletedCount
            ]);

            return [
                'success' => true,
                'orphaned_files' => $orphanedFiles,
                'deleted_count' => $deletedCount
            ];

        } catch (\Exception $e) {
            Log::error('Erro na limpeza de imagens órfãs', [
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
