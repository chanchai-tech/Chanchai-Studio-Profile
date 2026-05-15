<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Generator | Chanchai Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'JetBrains Mono', monospace; background-color: #080c14; }
        .glass-card { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="text-slate-300 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full glass-card p-8 rounded-3xl shadow-2xl ui-assembly">
        <h2 class="text-2xl font-bold text-white mb-6 text-center border-b border-slate-800 pb-4">
            QR <span class="text-cyan-500">GENERATOR</span>
        </h2>

        <?php
        include('phpqrcode/qrlib.php');
        $data = $_GET['data'] ?? '';
        $size = $_GET['size'] ?? 6;

        if ($data) {
            $tempDir = "temp/";
            if (!file_exists($tempDir)) mkdir($tempDir);
            $fileName = $tempDir . 'qr_' . md5($data) . '.png';
            QRcode::png($data, $fileName, 'H', $size, 2);
            
            echo '<div class="flex flex-col items-center mb-6">';
            echo '<div class="p-3 bg-white rounded-2xl shadow-[0_0_30px_rgba(34,211,238,0.3)]">';
            echo '<img src="'.$fileName.'" class="w-48 h-48">';
            echo '</div>';
            echo '<a href="'.$fileName.'" download class="mt-4 text-xs text-cyan-400 hover:underline">Download Image</a>';
            echo '</div>';
        }
        ?>

        <form action="qrcode.php" method="get" class="space-y-4">
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-slate-500 mb-1">Target URL / Text</label>
                <input type="text" name="data" value="<?php echo htmlspecialchars($data); ?>" placeholder="https://..." 
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cyan-500 text-white">
            </div>
            
            <div>
                <label class="block text-[10px] uppercase tracking-widest text-slate-500 mb-1">QR Size</label>
                <select name="size" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-300">
                    <option value="4" <?php if($size==4) echo 'selected'; ?>>Small</option>
                    <option value="6" <?php if($size==6) echo 'selected'; ?>>Medium</option>
                    <option value="10" <?php if($size==10) echo 'selected'; ?>>Large</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-cyan-900/20">
                GENERATE NOW
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="index.php" class="text-xs text-slate-600 hover:text-slate-400">← Back to Hub</a>
        </div>
    </div>

</body>
</html>