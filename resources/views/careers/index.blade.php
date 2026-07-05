<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif !important; }
        body { background: #f8fafc; padding: 50px 0; }
        .career-card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-apply { background: #2563eb; color: white; border-radius: 12px; font-weight: 700; padding: 12px 30px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card career-card p-5">
                <div class="text-center mb-5">
                    <i class="fa-solid fa-graduation-cap fa-3x text-primary mb-3"></i>
                    <h2 class="fw-bold">Join Our Academic Team</h2>
                    <p class="text-muted">Apply today to start your career at our school branches.</p>
                </div>

                <form action="{{ route('careers.apply') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small fw-bold">ENGLISH NAME</label>
                            <input type="text" name="english_name" class="form-control" placeholder="E.g. JOHN DOE" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold">ឈ្មោះជាភាសាខ្មែរ (KHMER NAME)</label>
                            <input type="text" name="khmer_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold">IDENTITY CARD</label>
                            <input type="text" name="identity_card" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold">BRANCH PREFERENCE</label>
                            <select name="branch_name" class="form-select">
                                <option>Phnom Penh Headquarters</option>
                                <option>Siem Reap Branch</option>
                                <option>Battambang Branch</option>
                            </select>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-apply shadow-sm">
                                <i class="fa-solid fa-paper-plane me-2"></i> Submit Application
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>