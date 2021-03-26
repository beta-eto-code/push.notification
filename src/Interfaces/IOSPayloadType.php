<?php


namespace Push\Interfaces;


interface IOSPayloadType
{
    const ALERT = 'alert';
    const SOUND = 'sound';
    const BADGE = 'badge';
    const SILENT = 'silent';
}
