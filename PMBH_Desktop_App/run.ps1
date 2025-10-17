# Script để chạy hai lệnh npm song song
# Kiểm tra và kill process trên port 3000 nếu có
$port = 3000
$process = netstat -ano | findstr ":$port"
if ($process) {
    $pid = ($process -split '\s+')[-1]
    $processName = (Get-Process -Id $pid).ProcessName
    if ($processName -eq "node") {
        Write-Host "Killing node.exe process on port $port (PID: $pid)"
        taskkill /PID $pid /F
    } else {
        Write-Host "Process on port $port is $processName, not killing"
    }
} else {
    Write-Host "Port $port is free"
}

# Chạy npm run electron-test trong background
$electronProcess = Start-Process -NoNewWindow -FilePath "cmd.exe" -ArgumentList "/c", "npm run electron-test" -PassThru

# Chạy npm start trong background (không mở browser nhờ .env.local)
$reactProcess = Start-Process -NoNewWindow -FilePath "cmd.exe" -ArgumentList "/c", "npm start" -PassThru

# Chờ Electron app tắt (monitor process electron.exe)
Write-Host "Waiting for Electron app to close..."
while (Get-Process electron -ErrorAction SilentlyContinue) {
    Start-Sleep -Seconds 1
}

# Khi Electron tắt, stop tất cả
Write-Host "Electron app closed, stopping all processes and killing port..."

# Kill React server process
if ($reactProcess -and !$reactProcess.HasExited) {
    taskkill /PID $reactProcess.Id /F
}

# Kill Electron cmd process nếu còn
if ($electronProcess -and !$electronProcess.HasExited) {
    taskkill /PID $electronProcess.Id /F
}

# Kill port 3000 nếu còn
$process = netstat -ano | findstr ":$port"
if ($process) {
    $pid = ($process -split '\s+')[-1]
    $processName = (Get-Process -Id $pid -ErrorAction SilentlyContinue).ProcessName
    if ($processName -eq "node") {
        Write-Host "Killing remaining node.exe on port $port (PID: $pid)"
        taskkill /PID $pid /F
    }
}

Write-Host "All processes stopped and port cleared."


