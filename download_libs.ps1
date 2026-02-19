$ErrorActionPreference = "Stop"

if (!(Test-Path "public/lib")) {
    New-Item -ItemType Directory -Path "public/lib" -Force
}

$files = @(
    @("https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js", "public/lib/sweetalert2.all.min.js"),
    @("https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css", "public/lib/toastify.min.css"),
    @("https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js", "public/lib/toastify.min.js"),
    @("https://cdn.plyr.io/3.7.8/plyr.css", "public/lib/plyr.css"),
    @("https://cdn.plyr.io/3.7.8/plyr.polyfilled.js", "public/lib/plyr.polyfilled.js"),
    @("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css", "public/lib/fontawesome.min.css")
)

foreach ($file in $files) {
    Write-Host "Downloading $($file[0]) to $($file[1])..."
    Invoke-WebRequest -Uri $file[0] -OutFile $file[1]
}

Write-Host "Done!"
