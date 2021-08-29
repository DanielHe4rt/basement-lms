<?php

namespace LMS\Lessons\Enums;

class UploadStatus
{
    const WAITING = 'waiting';
    const CREATING_ASSET = 'creating asset';
    const GRANTING_PERMISSION = 'granting permissions';
    const PREPARING_UPLOAD = 'preparing to upload';
    const OUTPUT_ASSET = 'generating output asset';
    const ENCODING_MEDIA = 'encoding';
    const CREATING_LOCATOR = 'creating locator';
    const DONE = 'done';
}
