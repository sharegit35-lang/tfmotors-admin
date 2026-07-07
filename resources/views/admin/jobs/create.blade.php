@extends('layouts.admin')

@section('title', 'Post New Job')
@section('header_title', 'បង្កើតការងារថ្មី')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
    <form action="{{ route('admin.jobs.store') }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">ចំណងជើងការងារ</label>
                <input type="text" name="title" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#d4af37]">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ប្រភេទ</label>
                    <select name="employment_type" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl">
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">ស្ថានភាព</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl">
                        <option value="Open">Open</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">ទីតាំង</label>
                <input type="text" name="location" value="Phnom Penh" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">ការពិពណ៌នា</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl"></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-[#0f2b3d] text-white rounded-xl font-bold hover:bg-[#123447]">
                ប្រកាសការងារ (Post Job)
            </button>
        </div>
    </form>
</div>
@endsection