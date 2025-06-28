# run with sail
run:
    ./vendor/bin/sail up -d
    tmux new-session -d -s "casa-new"
    tmux send-keys -t "casa-new" "just vite" ENTER

run_front:
    ./vendor/bin/sail up -d
    tmux new-session -d -s "casa-new"
    tmux send-keys -t "casa-new" "npm run dev" ENTER

biome:
    ./vendor/bin/sail npm run lint

vite:
  ./vendor/bin/sail npm run dev

install dep="":
  ./vendor/bin/sail npm install {{dep}}

artisan cmd:
  ./vendor/bin/sail artisan {{cmd}}

go_adminer:
    open "http://localhost:8080/?server=pgsql&username=sail&db=laravel"
