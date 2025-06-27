<?php
session_start();
$conn = new mysqli("localhost", "root", "", "investernak");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                <?= $_SESSION['success'] ?>
            </div>
        <?php unset($_SESSION['success']);
        endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <?= $_SESSION['error'] ?>
            </div>
        <?php unset($_SESSION['error']);
        endif; ?>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <!-- Nama -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                    class="w-full mt-1 px-4 py-2 border rounded">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                    class="w-full mt-1 px-4 py-2 border rounded">
            </div>

            <!-- NIK -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" value="<?= htmlspecialchars($user['nik'] ?? '') ?>"
                    class="w-full mt-1 px-4 py-2 border rounded">
            </div>

            <!-- Bank -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Bank</label>
                <select name="id_bank" class="w-full mt-1 px-4 py-2 border rounded">
                    <option value="">-- Pilih Bank --</option>
                    <?php
                    $query = $conn->query("SELECT id, nama_bank FROM bank");
                    while ($bank = $query->fetch_assoc()) {
                        $selected = ($user['id_bank'] ?? '') == $bank['id'] ? 'selected' : '';
                        echo "<option value=\"{$bank['id']}\" $selected>{$bank['nama_bank']}</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Saldo -->
            <div class="mb-6">
                <label class="block font-medium text-gray-700">Saldo</label>
                <input type="number" name="saldo" value="<?= htmlspecialchars($user['saldo'] ?? 0) ?>"
                    class="w-full mt-1 px-4 py-2 border rounded">
            </div>

            <div class="flex justify-end gap-2">
                <a href="javascript:history.back()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>

</html>