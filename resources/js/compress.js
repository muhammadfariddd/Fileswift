document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("file-input");
    const fileInfo = document.getElementById("file-info");
    const compressBtn = document.getElementById("compress-btn");
    const loadingSpinner = document.getElementById("loading-spinner");
    const form = document.getElementById("compress-form");

    if (dropArea && fileInput) {
        dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropArea.classList.add("border-blue-400");
        });
        dropArea.addEventListener("dragleave", (e) => {
            e.preventDefault();
            dropArea.classList.remove("border-blue-400");
        });
        dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            dropArea.classList.remove("border-blue-400");
            const file = e.dataTransfer.files[0];
            fileInput.files = e.dataTransfer.files;
            handleFile(file);
        });
        fileInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            handleFile(file);
        });
    }

    function handleFile(file) {
        if (!file) return;
        fileInfo.classList.remove("hidden");
        fileInfo.innerHTML = `<div class="font-semibold text-white">${
            file.name
        }</div><div class="text-sm text-gray-500">${(
            file.size /
            1024 /
            1024
        ).toFixed(2)} MB</div>`;
        compressBtn.classList.remove("hidden");
    }

    if (form) {
        form.addEventListener("submit", function (e) {
            loadingSpinner.classList.remove("hidden");
            loadingSpinner.innerHTML = `<div class='absolute inset-0 flex items-center justify-center bg-white/80 rounded-lg z-10'>
                <svg class='animate-spin h-10 w-10 text-blue-600' viewBox='0 0 24 24'>
                    <circle class='opacity-25' cx='12' cy='12' r='10' stroke='currentColor' stroke-width='4' fill='none' />
                    <path class='opacity-75' fill='currentColor' d='M4 12a8 8 0 018-8v8z' />
                </svg>
            </div>`;
        });
    }
});
