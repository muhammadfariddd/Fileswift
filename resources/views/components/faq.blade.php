<section class="bg-gray-50">
    <div class="container mx-auto max-w-4xl px-6 py-12 sm:py-16 lg:px-8">

        <!-- Header -->
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-secondary sm:text-4xl">
                Pertanyaan yang Sering Diajukan
            </h2>
        </div>

        <!-- Accordion Container -->
        <div x-data="{ activeAccordion: null }" class="mt-12 space-y-4 cursor-pointer">

            <!-- FAQ Item 1 -->
            <div x-data="{ id: 1 }"
                class="rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-secondary hover:shadow-md">
                <h2>
                    <button type="button" @click="activeAccordion = (activeAccordion === id) ? null : id"
                        class="flex w-full items-center justify-between p-6 text-left font-semibold text-primary cursor-pointer">
                        <span>Apakah layanan kompres file ini gratis?</span>
                        <svg :class="{ 'rotate-180 text-secondary': activeAccordion === id }"
                            class="h-6 w-6 shrink-0 transform transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </h2>
                <div x-show="activeAccordion === id" x-collapse class="px-6 pb-6">
                    <p class="text-gray-700">
                        Ya, semua fitur kompres file di FileSwift dapat digunakan secara gratis tanpa perlu registrasi
                        atau biaya tambahan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div x-data="{ id: 2 }"
                class="rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-secondary hover:shadow-md">
                <h2>
                    <button type="button" @click="activeAccordion = (activeAccordion === id) ? null : id"
                        class="flex w-full items-center justify-between p-6 text-left font-semibold text-primary cursor-pointer">
                        <span>File apa saja yang bisa dikompres di FileSwift?</span>
                        <svg :class="{ 'rotate-180 text-secondary': activeAccordion === id }"
                            class="h-6 w-6 shrink-0 transform transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </h2>
                <div x-show="activeAccordion === id" x-collapse class="px-6 pb-6">
                    <p class="text-gray-700">
                        Anda dapat mengompres berbagai jenis file seperti gambar (JPG, PNG), dokumen PDF, dan file lain
                        yang didukung oleh sistem kami.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div x-data="{ id: 3 }"
                class="rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-secondary hover:shadow-md">
                <h2>
                    <button type="button" @click="activeAccordion = (activeAccordion === id) ? null : id"
                        class="flex w-full items-center justify-between p-6 text-left font-semibold text-primary cursor-pointer">
                        <span>Apakah data saya aman bersama Anda?</span>
                        <svg :class="{ 'rotate-180 text-secondary': activeAccordion === id }"
                            class="h-6 w-6 shrink-0 transform transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </h2>
                <div x-show="activeAccordion === id" x-collapse class="px-6 pb-6">
                    <p class="text-gray-700">
                        Keamanan adalah prioritas utama kami. Kami menggunakan enkripsi standar industri (AES-256) untuk
                        melindungi data Anda saat transit dan saat disimpan. Server kami berada di pusat data yang aman
                        dengan sertifikasi SOC 2 dan kami melakukan audit keamanan secara berkala.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
