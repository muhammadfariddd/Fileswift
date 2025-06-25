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
        // Validasi ukuran file (maksimal 50MB)
        if (file.size > 50 * 1024 * 1024) {
            showNotification(
                "Ukuran file maksimal 50MB! Silakan pilih file yang lebih kecil.",
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

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            showLoadingSpinner();

            const file = fileInput.files[0];
            if (!file) {
                showNotification("Pilih file terlebih dahulu.", "warning");
                hideLoadingSpinner();
                return;
            }
            const formatRadio = form.querySelector(
                'input[name="target_format"]:checked'
            );
            if (!formatRadio) {
                showNotification("Pilih format output.", "warning");
                hideLoadingSpinner();
                return;
            }
            const toFormat = formatRadio.value;

            const formData = new FormData();
            formData.append("file", file);
            formData.append("to_format", toFormat);
            // Tambahkan CSRF token
            const csrf = document.querySelector('input[name="_token"]');
            if (csrf) {
                formData.append("_token", csrf.value);
            }

            // Coba fetch terlebih dahulu
            fetch(form.action, {
                method: "POST",
                body: formData,
                credentials: "same-origin",
            })
                .then(async (response) => {
                    // Coba parse sebagai JSON terlebih dahulu
                    const contentType = response.headers.get("content-type");
                    if (
                        contentType &&
                        contentType.includes("application/json")
                    ) {
                        return response.json().then((data) => {
                            console.log("JSON response:", data);
                            if (data.redirect) {
                                console.log("Redirecting to:", data.redirect);
                                window.location.href = data.redirect;
                            } else if (data.error) {
                                // Tambahan: alert khusus untuk CloudConvert limit
                                if (
                                    data.error
                                        .toLowerCase()
                                        .includes("cloudconvert")
                                ) {
                                    showNotification(
                                        "❗ Penggunaan Fitur ini telah mencapai batas. Silahkan coba lagi nanti.\n" +
                                            data.error,
                                        "warning"
                                    );
                                } else {
                                    showNotification(data.error, "warning");
                                }
                                hideLoadingSpinner();
                            } else {
                                showNotification(
                                    "Konversi gagal. Cek file/format.",
                                    "warning"
                                );
                                hideLoadingSpinner();
                            }
                        });
                    } else {
                        // Fallback: parse sebagai HTML untuk error
                        return response.text().then((html) => {
                            console.log("HTML response length:", html.length);
                            // Cek apakah ada redirect di HTML response
                            const redirectMatch = html.match(
                                /window\.location\.href\s*=\s*['"]([^'"]+)['"]/
                            );
                            if (redirectMatch) {
                                console.log(
                                    "Found redirect in HTML:",
                                    redirectMatch[1]
                                );
                                window.location.href = redirectMatch[1];
                                return;
                            }

                            // Ambil pesan error dari response HTML
                            let match = html.match(
                                /<div[^>]*class=["'][^"']*bg-red-100[^"']*["'][^>]*>([\s\S]*?)<\/div>/
                            );
                            let msg = match
                                ? match[1].replace(/<[^>]+>/g, "").trim()
                                : "Terjadi error pada server. Silakan coba lagi atau cek limit CloudConvert Anda.";
                            showNotification(msg, "warning");
                            hideLoadingSpinner();
                        });
                    }
                })
                .catch((error) => {
                    hideLoadingSpinner();
                    console.error("Fetch error:", error);
                    showNotification(
                        "Terjadi error pada server. Silakan coba lagi atau cek limit CloudConvert Anda.",
                        "warning"
                    );
                });
        });
    }

    function showNotification(message, type = "info") {
        // Create notification element
        const notification = document.createElement("div");
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 max-w-sm ${
            type === "success"
                ? "bg-green-100 text-green-800 border border-green-300"
                : type === "warning"
                ? "bg-yellow-100 text-yellow-800 border border-yellow-300"
                : "bg-blue-100 text-blue-800 border border-blue-300"
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(notification);
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }
});
