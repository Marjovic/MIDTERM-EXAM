<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Announcements - MGOD LMS' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap me-2"></i>MGOD LMS</a>
            <div class="navbar-nav ms-auto">
                <?php if ($user['role'] === 'admin'): ?>
                    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
                <?php elseif ($user['role'] === 'teacher'): ?>
                    <a class="nav-link" href="<?= base_url('teacher/dashboard') ?>"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-bullhorn text-success mb-3" style="font-size: 3rem;"></i>
                        <h1 class="card-title text-success">Announcements</h1>
                        <p class="card-text">Welcome, <?= esc($user['name']) ?>! Stay updated with the latest announcements.</p>
                        <p class="text-muted">Role: <?= ucfirst(esc($user['role'])) ?> | Email: <?= esc($user['email']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Announcements List -->
        <div class="row">
            <div class="col-12">
                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $announcement): ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-success text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-megaphone me-2"></i><?= esc($announcement['title']) ?>
                                    </h5>
                                    <small class="text-light">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        <?= date('F j, Y \a\t g:i A', strtotime($announcement['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="announcement-content">
                                    <p class="card-text"><?= nl2br(esc($announcement['content'])) ?></p>
                                </div>
                                <hr>
                                <div class="text-muted small">
                                    <i class="fas fa-clock me-1"></i>
                                    Posted on <?= date('l, F j, Y', strtotime($announcement['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-inbox text-muted mb-3" style="font-size: 4rem;"></i>
                            <h3 class="text-muted">No Announcements Yet</h3>
                            <p class="text-muted">There are currently no announcements to display. Please check back later.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>