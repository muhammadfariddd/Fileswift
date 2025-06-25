// resources/js/merge.js

document.addEventListener("DOMContentLoaded", function () {
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("file-input");
    const fileList = document.getElementById("file-list");
    const mergeBtn = document.getElementById("merge-btn");
    const loadingSpinner = document.getElementById("loading-spinner");
    const form = document.getElementById("merge-form");
    let files = [];

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
            addFiles(e.dataTransfer.files);
        });
        fileInput.addEventListener("change", (e) => {
            addFiles(e.target.files, true);
        });
    }

    function addFiles(newFiles) {
        const allowedExt = ["pdf"];
        let addedCount = 0;
        let rejectedCount = 0;
        let rejectedTypes = [];

        for (let i = 0; i < newFiles.length; i++) {
            const ext = newFiles[i].name.split(".").pop().toLowerCase();
            if (allowedExt.includes(ext)) {
                files.push(newFiles[i]);
                addedCount++;
            } else {
                rejectedCount++;
                rejectedTypes.push(ext);
            }
        }

        if (rejectedCount > 0) {
            showNotification(
                `${rejectedCount} file (${rejectedTypes.join(
                    ", "
                )}) berhasil ditambahkan.`,
                "success"
            );
        }

        if (addedCount > 0) {
            showNotification(
                `${addedCount} file PDF berhasil ditambahkan.`,
                "success"
            );
        }

        renderFileList();
        mergeBtn.classList.toggle("hidden", files.length < 2);

        // Reset file input agar event change selalu terpicu
        fileInput.value = "";
    }

    function renderFileList() {
        fileList.innerHTML = "";
        files.forEach((file, idx) => {
            fileList.innerHTML += `<div class='flex items-center justify-between bg-(--color-success) rounded px-3 py-2 mb-2'>
                <span class='font-semibold'>${file.name}</span>
                <button type='button' class='text-red-500 hover:text-red-700' onclick='removeFile(${idx})'>
                <i class='fas fa-trash-alt'></i>
                </button>
            </div>`;
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

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

    window.removeFile = function (idx) {
        const removedFile = files[idx];
        files.splice(idx, 1);
        renderFileList();
        mergeBtn.classList.toggle("hidden", files.length < 2);
        showNotification(`File "${removedFile.name}" dihapus.`, "info");
    };

    // Tambahkan fungsi untuk menampilkan dan menyembunyikan overlay spinner
    function showLoadingSpinner() {
        let overlay = document.getElementById("loading-overlay");
        const formCard = document.getElementById("merge-form");
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
            if (files.length < 2) {
                e.preventDefault();
                showNotification(
                    "Minimal 2 file PDF diperlukan untuk penggabungan.",
                    "warning"
                );
                return;
            }
            e.preventDefault();
            showLoadingSpinner();

            const formData = new FormData();
            files.forEach((file) => {
                formData.append("files[]", file);
            });
            // Tambahkan CSRF token
            const csrf = document.querySelector('input[name="_token"]');
            if (csrf) {
                formData.append("_token", csrf.value);
            }

            fetch(form.action, {
                method: "POST",
                body: formData,
                credentials: "same-origin",
            })
                .then(async (response) => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        hideLoadingSpinner();
                        return response.text().then((html) => {
                            // Tampilkan error dari response jika ada
                            showNotification(
                                "Gagal menggabungkan file. Cek file Anda.",
                                "warning"
                            );
                        });
                    }
                })
                .catch((error) => {
                    hideLoadingSpinner();
                    showNotification(
                        "Terjadi kesalahan saat mengirim file.",
                        "warning"
                    );
                });
        });
    }
});
