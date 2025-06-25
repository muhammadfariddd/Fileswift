@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12 px-4 min-h-[70vh] flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Hubungi Kami</h1>
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto text-lg text-gray-700 leading-relaxed">
            <p class="mb-4">Apakah Anda memiliki pertanyaan, saran, atau masukan? Jangan ragu untuk menghubungi tim
                FileSwift. Kami siap membantu Anda!</p>

            <div class="mt-6">
                <p class="font-semibold">Email:</p>
                <p class="mb-4"><a href="mailto:support@fileswift.com"
                        class="text-blue-600 hover:underline">support@fileswift.com</a></p>

                <p class="font-semibold">Alamat (Contoh):</p>
                <p class="mb-4">Jalan Teknologi No. 123, Kota Digital, Negara Konversi</p>

                <p class="font-semibold">Jam Operasional:</p>
                <p>Senin - Jumat: 09:00 - 17:00 (Waktu Lokal)</p>
            </div>

            <p class="mt-8 text-center text-sm text-gray-500">Kami akan berusaha merespons pesan Anda secepat mungkin.</p>
        </div>
    </div>
@endsection
