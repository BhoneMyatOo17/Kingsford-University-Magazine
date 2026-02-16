<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * Disk names mapped to upload type.
     * To switch all uploads to a different driver,
     * only the disk config in filesystems.php needs updating.
     */
    const DISK_PROFILES   = 's3_profiles';
    const DISK_IMAGES     = 's3_images';
    const DISK_DOCUMENTS  = 's3_documents';

    /**
     * Upload a profile picture.
     * Deletes the old file if a path is provided.
     */
    public function uploadProfilePicture(UploadedFile $file, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->delete($oldPath, self::DISK_PROFILES);
        }

        return $file->store('profile_pictures', self::DISK_PROFILES);
    }

    /**
     * Upload a contribution image (high quality).
     * Deletes the old file if a path is provided.
     */
    public function uploadContributionImage(UploadedFile $file, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->delete($oldPath, self::DISK_IMAGES);
        }

        return $file->store('contribution_images', self::DISK_IMAGES);
    }

    /**
     * Upload a contribution document (Word file).
     * Deletes the old file if a path is provided.
     */
    public function uploadContributionDocument(UploadedFile $file, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->delete($oldPath, self::DISK_DOCUMENTS);
        }

        return $file->store('contribution_documents', self::DISK_DOCUMENTS);
    }

    /**
     * Get a public URL for a profile picture.
     */
    public function profilePictureUrl(string $path): string
    {
        return Storage::disk(self::DISK_PROFILES)->url($path);
    }

    /**
     * Get a public URL for a contribution image.
     */
    public function contributionImageUrl(string $path): string
    {
        return Storage::disk(self::DISK_IMAGES)->url($path);
    }

    /**
     * Get a temporary signed URL for a private contribution document.
     * Documents are private — coordinators/managers access via signed URL.
     *
     * @param  int  $expiryMinutes
     */
    public function contributionDocumentUrl(string $path, int $expiryMinutes = 30): string
    {
        return Storage::disk(self::DISK_DOCUMENTS)->temporaryUrl(
            $path,
            now()->addMinutes($expiryMinutes)
        );
    }

    /**
     * Delete a file from a given disk.
     */
    public function delete(string $path, string $disk): void
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}