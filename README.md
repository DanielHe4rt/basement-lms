<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Basement LMS

A criação da LMS vai dar ênfase em uma facilidade maior para que outros desenvolvedores Laravel entendam como é a modelagem de tudo.


Essa aplicação ainda está em desenvolvimento, caso você queira integrar ao time, mande um e-mail para os mantenedores!

```
danielhe4rt: hey@danielheart.dev
```

### Projeto
1. [] Base do Projeto
   1. Tecnologias:
      1. [x] Bootstrap 4/5
      2. [x] Azure Stream 
      3. [x] Docker 
      4. [] Larastan
2. [] Autenticação
    * [x] Métodos base: Sessão
    * [] Métodos custom: Google, Github e Twitch
3. [] Cursos
    1. [] Modelagem Admin
       1. [X] Pagina de Criação de cursos
       2. [X] Pagina de Criação de módulos
          1. [] Ordenação de módulos
       3. [X] Pagina de Criação de Lições
          1. [X] Lições de Video
          2. [X] Lições em Artigos
          3. [] Lições em Quiz 
          4. [] Ordenação de Lições
    2. [] Modelagem User 
       1. [] Pagina inicial com todos os cursos
       2. [] Pagina principal de um curso
       3. [] Pagina para assistir o curso
4. [] Subscrição
    1. [] Método de pagamento: Stripe, GerenciaNet, Pagarme, Picpay
    2. [] Vinculação com Twitch: Subzada do Daniel é na faixa
    3. [] Formulário não pagante: Se não houver condições de comprar, deixa o salve que a gente libera!
5. Gameficação


### Instalação
1. Clone este repositório usando esse comando:
```terminal
$ git clone  https://github.com/DanielHe4rt/basement-lms
```
2. Acesse a pasta do projeto em seu terminal:
```terminal
$ cd basement-lms
```
3. Rode o comando de instalação das bibliotecas PHP do composer para que possamos ter todas nossas depedências do projeto instaladas.
```terminal
$ composer install
``` 
4. Copie o arquivo de configuração de exemplo para um arquivo de configuração real:
```terminal
$ cp .env.example .env
```

5. (Opcional) caso **não** vá utilizar o Sail como recomendamos é necessário mudar os valores em .env para que ele possa acessar seu Banco de Dados, os valores são:
    * **DB_DATABASE**: Que é o nome do Banco de Dados (BD) que você precisa criar previamente.
    * **DB_USERNAME**: O nome do usuário do seu BD.
    * **DB_PASSWORD**: A senha desse usuário.
Configurações padrão (de exemplo):
```
DB_DATABASE=lms_laravel
DB_USERNAME=root
DB_PASSWORD=root
```

> Caso precise de ajuda com o terminal você pode consultar o [zsh4noobs](https://github.com/edersonferreira/zsh4noobs) ou o [wsl4noobs](https://github.com/SaLandini/wsl4noobs).

### Instalação Laravel Sails

> **Importante**: Certifique-se que as portas 80 e 3306 do seu computador estão liberadas, caso seja necessário desative o serviço de BD e Apache, caso contrário poderão ocorrer falhas por essas portas estarem ocupadas no processo de subir a imagem do Sail.

1. Execute esse comando para instalar a ferramenta Sail em seu projeto Laravel
```terminal
$ php artisan sail:install
```
> **Obs:** Preste atenção que Laravel Sail irá trocar a chave `DB_USERNAME` e `DB_PASSWORD` para `DB_USERNAME=sail` e `DB_PASSWORD=password`. **Não** mude esses valores.

2. Selecione `mariadb` ou `mysql` conforme a preferência.
3. Crie um alias em seu ~/.bashrc (ou seu ~/.zshrc caso use zsh).
```terminal
$ echo 'alias sail=\'bash vendor/bin/sail\'' >> ~/.bashrc
```

> **Obs 1:** Caso você não crie o alias 'sail' será necessário utilizar 'bash vendor/bin/sail' seguido do comando que deseja usar toda vez que quiser usar um comando.

> **Obs 2:** Dependendo seu sistema e suas políticas de segurança pode ser que seja necessário usar o comando **sudo** para elevar as permissões.
```
4. Adicione algumas chaves necessárias para que o docker possa fazer a build da imagem, para isso rode os comandos.
```terminal
$ export APP_SERVICE=${APP_SERVICE:-"laravel.test"}
$ export DB_PORT=${DB_PORT:-3306}
$ export WWWUSER=${WWWUSER:-$UID}
$ export WWWGROUP=${WWWGROUP:-$(id -g)}
```
(*Isso é devido a uma falha de configuração na imagem padrão do Laravel que o Sails usa e é explicado [aqui](https://stackoverflow.com/a/67508274) pode ser que futuramente não seja necessário.*)

5. Agora use o comando para subir sua aplicação.
```terminal
$ sail up -d
```
> Pode ser necessário **sudo**.

> Caso seja mudado algo em `docker-compose.yml` é recomendado que use o comando `sail up -d --build`` para fazer a build dos novos containers e em seguida `sail up`.

6. Precisamos entrar no nosso Docker e dar as permissões de escrita para as pastas de log e storage do Laravel:
```
$ sail root-shell
# chmod -R 777 storage
# chmod -R 777 bootstrap/cache
```

#### Pronto! Agora basta acessar [http://localhost/](http://localhost/) e começar os trabalhos.

<hr>

Email settings (using a provider like Mailgun, Amazon SES, etc)

* Run `sail artisan key:generate`
* Run `sail artisan migrate`
* For Auth API (to configure Laravel Passport), run: `sail artisan passport:install`
* Run `sail npm install`
* Run `sail artisan db:seed`

* Start the Websocket server (for chat functionality) `sail artisan websockets:serve`



The application is running on `localhost:8000`
