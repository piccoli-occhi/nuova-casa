# install deps, seed and run project with sail
init:
    composer install
    ./vendor/bin/sail up -d
    ./vendor/bin/sail npm install
    ./vendor/bin/sail artisan migrate
    ./vendor/bin/sail artisan db:seed
    just run

# run with sail
run:
    ./vendor/bin/sail up -d
    tmux new-session -d -s "casa"
    tmux send-keys -t "casa" "just vite" ENTER

# Run front with vite
vite:
  ./vendor/bin/sail npm run dev

# Lint front code with biome
biome:
    ./vendor/bin/sail npm run lint

# Lint front and back code
lint:
    just biome
    just pint_fix

# Test and fix files with Pint
pint_fix file="":
    ./vendor/bin/pint {{file}}

# Install all or one deps with npm
install dep="":
  ./vendor/bin/sail npm install {{dep}}

# Run a command with artisan
artisan *cmd:
  ./vendor/bin/sail artisan {{cmd}}

# Open admin
go_adminer:
    open "http://localhost:8080/?server=pgsql&username=sail&db=laravel"

# Generate a key with artisan
generate:
    ./vendor/bin/sail artisan key:generate

# Seed DB
seed:
    ./vendor/bin/sail artisan db:seed

# Build front
build:
    ./vendor/bin/sail npm run build
