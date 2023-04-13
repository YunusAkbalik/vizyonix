<?php

namespace App\Http\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileUpload
{
    public const ERROR_EMPTY_FILE = 'Lütfen en az bir dosya seçiniz.';
    public const ERROR_FILE_MAX_SIZE = 'Dosya boyutu en fazla 5MB olmalıdır.';
    public const ERROR_NOT_VALID_EXTENSION = 'Lütfen geçerli bir dosya formatı seçiniz.';

    protected string $path;

    protected array $mimeTypes;

    protected array $filePaths;

    protected string $requestFileName = 'file';

    protected string $errorMessage;

    public function save(): bool
    {
        if (!request()->file($this->requestFileName) || empty(request()->file($this->requestFileName))) {
            $this->setErrorMessage(self::ERROR_EMPTY_FILE);
            return false;
        }

        foreach (request()->file($this->requestFileName) as $file) {
            if (!$this->validate($file)) {
                return false;
            }

            $fileName = time() . '_' . Str::random(20) . '.' . $file->getClientOriginalExtension();
            $this->setFilePaths($file->move($this->path, $fileName));
        }

        return true;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function setMimeTypes(array $mimeTypes): self
    {
        $this->mimeTypes = $mimeTypes;
        return $this;
    }

    public function setRequestFileName(string $requestFileName): self
    {
        $this->requestFileName = $requestFileName;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getFilePaths(): array
    {
        return $this->filePaths;
    }

    protected function setErrorMessage(string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    protected function setFilePaths(string $filePath): void
    {
        $this->filePaths[] = $filePath;
    }

    protected function validate(UploadedFile $file): bool
    {
        if (!$this->mimeTypeControl($file)) {
            $this->setErrorMessage(self::ERROR_NOT_VALID_EXTENSION);
            return false;
        }

        if (!$this->sizeControl($file)) {
            $this->setErrorMessage(self::ERROR_FILE_MAX_SIZE);
            return false;
        };

        return true;
    }

    protected function mimeTypeControl(UploadedFile $file): bool
    {

        return in_array($file->getClientOriginalExtension(), $this->mimeTypes, true);
    }

    protected function sizeControl(UploadedFile $file): bool
    {
        return $file->getSize() < 5000000;
    }
}
