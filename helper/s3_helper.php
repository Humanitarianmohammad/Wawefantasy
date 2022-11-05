<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


function getS3Url($path = '')
{
    $url = '';
    if (!empty($path)) {
        $url = Storage::disk('s3')->temporaryUrl(
            $path,
            now()->addMinutes(10),
        );
    }
    return $url;
}


function getS3UrlByFid($fid = 0)
{
    $url = '';
    $file_data = DB::table('file_manage')->where(['fid' => $fid])
        ->first();

    if (!empty($file_data)) {
        $url = Storage::disk('s3')->temporaryUrl(
            $file_data->uri,
            now()->addMinutes(10),
        );
    }
    return $url;
}


function epochToDate($timestamp = 0)
{
    if (!empty($timestamp)) {
        $pepoch = $timestamp;
        $pdt = new DateTime("@$pepoch");  // convert UNIX timestamp to PHP DateTime
        return $pdt->format('d/m/Y');
    } else {
        return '';
    }
}

function getFileNameByFid($fid = 0)
{
    $file_name = '';
    $file_data = DB::table('file_manage')->where(['fid' => $fid])
        ->first();

    if (!empty($file_data)) {
        $file_name = $file_data->file_name;
    }
    return $file_name;
}

function getTotalTime($timestamp = 0)
{
    $time_text = $hours = $minutes = '';

    if (!empty($timestamp)) {

        $minutes =  $hours = 00;
        if ($timestamp >= 3600) {
            $hours = $timestamp / 3600;
        }
        $minutes = ($timestamp % 3600) / 60;
        // $time_text = $hours . ':' . $minutes;
    }

    return number_format($hours, 0) . ' h' . ' ' . number_format($minutes, 0) . ' m';
}
