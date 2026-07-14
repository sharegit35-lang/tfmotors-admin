<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation | [ឈ្មោះកូនកំលោះ] & [ឈ្មោះកូនក្រមុំ]</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bayon&family=Inter:wght@300;400;600&display=swap');
        body { background: #fdfaf6; font-family: 'Inter', sans-serif; color: #4a4a4a; }
        .font-khmer { font-family: 'Bayon', cursive; }
        .gold-text { color: #b4863c; }
        .gold-bg { background-color: #b4863c; }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <div class="max-w-lg w-full bg-white p-10 rounded-3xl shadow-2xl border-t-[8px] border-[#b4863c] text-center">
        <h1 class="font-khmer text-5xl mb-6 gold-text">អាពាហ៍ពិពាហ៍</h1>
        <div class="space-y-2 mb-8">
            <p class="text-2xl font-semibold text-gray-800">[ឈ្មោះកូនកំលោះ]</p>
            <p class="text-gray-400">&</p>
            <p class="text-2xl font-semibold text-gray-800">[ឈ្មោះកូនក្រមុំ]</p>
        </div>
        
        <div class="mb-10 p-5 bg-[#fdfaf6] rounded-xl border border-[#b4863c]/20">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">កាលបរិច្ឆេទ</p>
            <p class="text-lg font-bold">ថ្ងៃទី [ថ្ងៃ] ខែ [ខែ] ឆ្នាំ [ឆ្នាំ]</p>
            <p class="text-sm mt-1">ម៉ោង [ម៉ោង] ព្រឹក/ល្ងាច</p>
        </div>

        <div class="mb-8">
            <h3 class="text-xs uppercase tracking-widest text-gray-400 mb-4">ទីតាំងមង្គលការ</h3>
            <div class="w-full h-64 rounded-2xl overflow-hidden shadow-inner border border-gray-100">
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <a href="https://maps.google.com/..." target="_blank" class="mt-4 inline-block gold-text font-bold hover:underline">
                📍 បើកមើលក្នុង Google Maps
            </a>
        </div>

        <form action="#" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="guest_name" placeholder="ឈ្មោះភ្ញៀវ" class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-[#b4863c] outline-none" required>
            <button type="submit" class="w-full gold-bg text-white py-4 rounded-xl font-bold hover:bg-[#93692b] transition-all shadow-lg">
                ចុះឈ្មោះចូលរួម (RSVP)
            </button>
        </form>
    </div>

</body>
</html>