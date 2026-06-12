function getIconByFileExt(ext) {
    let icon = null;
    if (ext === "mp3" || ext === "wav" || ext === "flac") {
        icon = "audiotrack";
    } else if (ext === "mp4" || ext === "mkv" || ext === "mov") {
        icon = "movie";
    } else if (ext === "jpg" || ext === "jpeg" || ext === "png" || ext === "gif" || ext === "webp") {
        icon = "image";
    } else if (ext === "pdf") {
        icon = "picture_as_pdf";
    } else if (ext === "doc" || ext === "docx") {
        icon = "description";
    } else if (ext === "xls" || ext === "xlsx") {
        icon = "table_chart";
    } else if (ext === "ppt" || ext === "pptx") {
        icon = "slideshow";
    } else if (ext === "zip" || ext === "rar" || ext === "7z") {
        icon = "folder_zip";
    } else if (ext === "txt" || ext === "md") {
        icon = "notes";
    } else if (ext === "html" || ext === "css" || ext === "js" || ext === "json") {
        icon = "code";
    } else if (ext === "php") {
        icon = "settings";
    } else {
        icon = "insert_drive_file"; // generic file icon
    }
    return icon;
}
