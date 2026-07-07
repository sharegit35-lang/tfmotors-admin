@extends('layouts.admin')

@section('title', 'Job Postings | TF Admin')
@section('header_title', 'បញ្ជីការងារ (Job Postings)')

@section('content')
<div class="w-full">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">ការងារដែលកំពុងជ្រើសរើស</h2>
        <a href="{{ route('admin.jobs.create') }}" class="px-5 py-2.5 rounded-xl font-semibold text-white shadow-lg"
           style="background: linear-gradient(135deg, var(--gold), var(--gold-light)); color: var(--navy-deep);">
            + បង្កើតការងារថ្មី
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 border-b border-slate-100 uppercase text-[11px] font-bold text-slate-500">
                <tr>
                    <th class="px-6 py-4">ចំណងជើងការងារ</th>
                    <th class="px-6 py-4">ប្រភេទ</th>
                    <th class="px-6 py-4">ទីតាំង</th>
                    <th class="px-6 py-4 text-center">ស្ថានភាព</th>
                    <th class="px-6 py-4 text-center">សកម្មភាព</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($jobs as $job)
                <tr>
                    <td class="px-6 py-4 font-bold">{{ $job->title }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $job->employment_type }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $job->location }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $job->status == 'Open' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $job->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('លុបមែនទេ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-rose-500 font-semibold">លុប</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection