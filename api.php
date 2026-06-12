<?php
    $dl = []; // directory list
    header("Content-type: application/json");

    function walker ($directory, $inclusions = [], $root = null) {
        if ($root == null) $root = realpath($directory);
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        foreach (scandir($directory) as $item) {
            if ($item == '.' || $item == '..') continue;
            if ($directory == "." && ($item == "api.php" || $item == 'index.html')) continue;
            if (in_array('item_type', $inclusions)) $dl[$item]["item_type"] = is_dir("{$directory}/{$item}") ? "folder" : "file";
            if (is_dir("{$directory}/{$item}")) {
                $dl[$item]['child'] = walker("{$directory}/{$item}", $inclusions, $root);
            } else {
                if (in_array('file_size', $inclusions)) $dl[$item]['file_size'] = filesize("{$directory}/{$item}");
                if (in_array('file_time', $inclusions)) $dl[$item]['file_time'] = filemtime("{$directory}/{$item}");
                if (in_array('file_url', $inclusions)) $dl[$item]['file_url'] = 
                    ($_SERVER['HTTPS']) ? "https://" : "http://" 
                    . $_SERVER['SERVER_ADDR'] . "/" 
                    . implode("/", array_diff(explode("/", realpath("{$directory}/{$item}")), explode("/", realpath("{$root}"))));
                if (in_array('file_url', $inclusions)) $dl[$item]['file_url_debug'] = [
                    realpath("{$directory}/{$item}"),
                    realpath("{$root}"),
                    implode("/", array_map('urlencode', array_diff(explode("/", realpath("{$directory}/{$item}")), explode("/", realpath("{$root}")))))
                ];
                if (in_array('file_mime', $inclusions)) $dl[$item]['file_mime'] = $finfo->file("{$directory}/{$item}"); // Slow and Expensive AF
            }
        }
        return $dl;
    }

    $dl = walker(".", ['file_size', 'item_type', 'file_mime', "file_url", "file_time"]);
    
    echo json_encode($dl);