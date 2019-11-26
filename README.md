# Sekoliko build status : [![CircleCI](https://circleci.com/gh/julkwel/sekoliko/tree/develop.svg?style=svg)](https://circleci.com/gh/julkwel/sekoliko/tree/develop)
[![All Contributors](https://img.shields.io/badge/all_contributors-4-orange.svg?style=flat-square)](#contributors)

School Management Web Application OPENSOURCE

## Requirements
```
composer
node && yarn
php > 7.1
```
## Usage
```
Step 1. Fork this project
Step 2. git clone https://github.com/[your_username]/sekoliko.git
Step 3. cd sekoliko && composer install
Step 4. yarn install
Step 5. configure .env to your own database
Step 5. bin/console doctrine:schema:update --force
Step 6. bin/console server:run
Step 7. yarn encore dev --watch
```
Create your first user by running 

`php bin/console sekoliko:create:super-admin`

## Design 
We need to make cool and user friendly design , inside assets there is an directory named admirator this is the template we used.

## Online test
[Sekoliko url](https://www.techzara.org/sekoliko/login) 

Use : 
```
login : sekoliko
password : sekoliko
```

## Functional proposition
IF YOU HAVE NEW PROPOSAL FUNCTION PLEASE CREATE NEW ISSUES.

**Make cool things :wink:**

## Contributors ✨

Thanks goes to these wonderful people ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore -->
<table>
  <tr>
    <td align="center"><a href="https://heuristic-raman-24225d.netlify.com"><img src="https://avatars1.githubusercontent.com/u/40351002?v=4" width="100px;" alt="SylvanoTombo"/><br /><sub><b>SylvanoTombo</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=SylvanoTombo" title="Code">💻</a></td>
    <td align="center"><a href="https://github.com/RinaVatosoa"><img src="https://avatars2.githubusercontent.com/u/45585022?v=4" width="100px;" alt="RinaVatosoa"/><br /><sub><b>RinaVatosoa</b></sub></a><br /><a href="#design-RinaVatosoa" title="Design">🎨</a></td>
    <td align="center"><a href="https://www.devinart.net/"><img src="https://avatars0.githubusercontent.com/u/35923219?v=4" width="100px;" alt="nyantso"/><br /><sub><b>nyantso</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=Nantso" title="Code">💻</a></td>
    <td align="center"><a href="https://github.com/chrys-elrak"><img src="https://avatars0.githubusercontent.com/u/40733956?v=4" width="100px;" alt="Chrys Rakotonimanana"/><br /><sub><b>Chrys Rakotonimanana</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=chrys-elrak" title="Code">💻</a></td>
  </tr>
</table>

<!-- ALL-CONTRIBUTORS-LIST:END -->

This project follows the [all-contributors](https://github.com/all-contributors/all-contributors) specification. Contributions of any kind welcome!