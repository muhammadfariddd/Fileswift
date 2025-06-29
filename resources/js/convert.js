document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("file-input");
    const fileInfo = document.getElementById("file-info");
    const formatOptions = document.getElementById("format-options");
    const convertBtn = document.getElementById("convert-btn");
    const loadingSpinner = document.getElementById("loading-spinner");
    const form = document.getElementById("convert-form");
    const chooseFilesBtn = document.getElementById("choose-files-btn");

    // Drag & Drop events
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

    if (chooseFilesBtn && fileInput) {
        chooseFilesBtn.addEventListener("click", (e) => {
            e.preventDefault();
            fileInput.click();
        });
    }

    function handleFile(file) {
        if (!file) return;
        // Validasi ukuran file (maksimal 500MB)
        if (file.size > 500 * 1024 * 1024) {
            showNotification(
                "Ukuran file maksimal 500MB! Silakan pilih file yang lebih kecil.",
                "warning"
            );
            fileInput.value = "";
            fileInfo.classList.add("hidden");
            formatOptions.classList.add("hidden");
            convertBtn.classList.add("hidden");
            return;
        }
        // Simpan pilihan format sebelumnya (jika ada)
        let prevFormat = null;
        const checkedRadio = formatOptions.querySelector(
            'input[name="target_format"]:checked'
        );
        if (checkedRadio) {
            prevFormat = checkedRadio.value;
        }
        // Show file info
        fileInfo.classList.remove("hidden");
        fileInfo.innerHTML = `<div class="font-semibold text-lg">${
            file.name
        }</div><div class="text-sm text-white/80">${(
            file.size /
            1024 /
            1024
        ).toFixed(2)} MB</div>`;
        // Show format options if needed
        showFormatOptions(file, prevFormat);
        convertBtn.classList.remove("hidden");
    }

    function showFormatOptions(file, prevFormat = null) {
        // Example: show format options based on file type
        let options = "";
        let ext = file.name.split(".").pop().toLowerCase();
        let formats = [];
        if (["jpg", "jpeg", "png", "webp", "bmp", "gif"].includes(ext)) {
            formats = ["pdf", "webp", "png", "jpg"];
        } else if (["doc", "docx", "odt", "rtf"].includes(ext)) {
            formats = ["pdf", "docx", "txt"];
        } else if (["xls", "xlsx", "csv"].includes(ext)) {
            formats = ["pdf", "xlsx", "csv"];
        } else if (["mp3", "wav", "ogg"].includes(ext)) {
            formats = ["mp3", "wav", "ogg"];
        } else if (["mp4", "mov", "avi", "mkv"].includes(ext)) {
            formats = ["mp4", "webm", "avi"];
        } else if (["pdf"].includes(ext)) {
            formats = ["jpg", "png", "docx"];
        } else {
            formats = ["pdf", "txt"];
        }
        // Hapus format yang sama dengan ekstensi file input
        formats = formats.filter((f) => f !== ext);
        if (formats.length > 0) {
            options = `<div class='mb-2 text-white font-semibold'>Pilih format output:</div><div class='flex flex-wrap gap-2'>`;
            formats.forEach((f, i) => {
                // Cek apakah format sebelumnya masih tersedia
                let checked = "";
                if (prevFormat && prevFormat === f) {
                    checked = "checked";
                } else if (!prevFormat && i === 0) {
                    checked = "checked";
                }
                options += `<label class='inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-lg cursor-pointer hover:bg-white/20'>
                    <input type='radio' name='target_format' value='${f}' ${checked} class='accent-blue-600'>
                    <span class='text-white font-medium uppercase'>.${f}</span>
                </label>`;
            });
            options += `</div>`;
            formatOptions.classList.remove("hidden");
            formatOptions.innerHTML = options;
        } else {
            formatOptions.classList.add("hidden");
            formatOptions.innerHTML = "";
        }
    }

    // Tambahkan fungsi untuk menampilkan dan menyembunyikan overlay spinner
    function showLoadingSpinner() {
        let overlay = document.getElementById("loading-overlay");
        const formCard = document.getElementById("convert-form");
        if (!overlay && formCard) {
            overlay = document.createElement("div");
            overlay.id = "loading-overlay";
            overlay.className =
                "absolute inset-0 flex items-center justify-center bg-white/80 rounded-xl z-40";
            overlay.innerHTML = `<div class='flex flex-col items-center'><svg class='animate-spin h-10 w-10 text-blue-600' viewBox='0 0 24 24'><circle class='opacity-25' cx='12' cy='12' r='10' stroke='currentColor' stroke-width='4' fill='none' /><path class='opacity-75' fill='currentColor' d='M4 12a8 8 0 018-8v8z' /></svg><div class="mt-4 text-dark font-semibold">Memproses...</div></div>`;
            formCard.style.position = "relative";
            formCard.appendChild(overlay);
        } else if (overlay) {
            overlay.style.display = "flex";
        }
    }
    function hideLoadingSpinner() {
        const overlay = document.getElementById("loading-overlay");
        if (overlay) overlay.style.display = "none";
    }
});
