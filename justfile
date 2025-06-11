# run with sail
run:
    ./vendor/bin/sail up -d
    tmux new-session -d -s "casa-new"
    tmux send-keys -t "casa-new" "just vite" ENTER

vite:
  ./vendor/bin/sail npm run dev

install dep="":
  ./vendor/bin/sail npm install {{dep}}

artisan cmd:
  ./vendor/bin/sail artisan {{cmd}}