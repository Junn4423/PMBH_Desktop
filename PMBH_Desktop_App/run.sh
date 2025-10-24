#!/bin/bash

# Script để chạy hai lệnh npm song song trên macOS
# Kiểm tra và kill process trên port 3000 nếu có
PORT=3000
PID=$(lsof -ti:$PORT)
if [ -n "$PID" ]; then
    PROCESS_NAME=$(ps -p $PID -o comm= | awk '{print $1}')
    if [ "$PROCESS_NAME" == "node" ]; then
        echo "Killing node process on port $PORT (PID: $PID)"
        kill -9 $PID
    else
        echo "Process on port $PORT is $PROCESS_NAME, not killing"
    fi
else
    echo "Port $PORT is free"
fi

# Chạy npm run electron-test trong background
npm run electron-test &
ELECTRON_PID=$!

# Chạy npm start trong background (không mở browser nhờ .env.local)
npm start &
REACT_PID=$!

# Chờ Electron app tắt (monitor process electron)
echo "Waiting for Electron app to close..."
while pgrep -x "Electron" > /dev/null; do
    sleep 1
done

# Khi Electron tắt, stop tất cả
echo "Electron app closed, stopping all processes and killing port..."

# Kill React server process
if kill -0 $REACT_PID 2>/dev/null; then
    kill -9 $REACT_PID
fi

# Kill Electron process nếu còn
if kill -0 $ELECTRON_PID 2>/dev/null; then
    kill -9 $ELECTRON_PID
fi

# Kill port 3000 nếu còn
PID=$(lsof -ti:$PORT)
if [ -n "$PID" ]; then
    PROCESS_NAME=$(ps -p $PID -o comm= | awk '{print $1}')
    if [ "$PROCESS_NAME" == "node" ]; then
        echo "Killing remaining node on port $PORT (PID: $PID)"
        kill -9 $PID
    fi
fi

echo "All processes stopped."