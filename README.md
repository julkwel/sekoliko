# Sekoliko build status : [![CircleCI](https://circleci.com/gh/julkwel/sekoliko/tree/develop.svg?style=svg)](https://circleci.com/gh/julkwel/sekoliko/tree/develop)
[![All Contributors](https://img.shields.io/badge/all_contributors-11-orange.svg?style=flat-square)](#contributors)

School Management Web Application OPENSOURCE

## Requirements
```
composer
node && yarn
php > 7.1
```
## Usage
Step 1. Fork this project

Step 2. 

`- git clone https://github.com/[your_username]/sekoliko.git`

Step 3. Create new branch 

`- git checkout -b feature/my-branch`

Step 4. Install composer dependencies

`- composer install` 

Step 5. Install node dependencies

`- yarn install`

Step 6. configure `.env` to your own database

Step 7. Update database schema

`- bin/console doctrine:schema:update --force`

Step 6. Run server

`- bin/console server:run`

Step 7. Run webpack server for assets

`- yarn encore dev --watch`

Create your first user by running 

`php bin/console sekoliko:create:super-admin`

## Design 
Make cool and user friendly design, we have a template admirator inside assets directory for theme.

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
    <td align="center"><a href="https://github.com/Fy-Rakotondrabe"><img src="https://avatars2.githubusercontent.com/u/45007981?v=4" width="100px;" alt="Fy Kely"/><br /><sub><b>Fy Kely</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=Fy-Rakotondrabe" title="Code">💻</a> <a href="#design-Fy-Rakotondrabe" title="Design">🎨</a></td>
    <td align="center"><a href="https://github.com/chrys-elrak"><img src="https://avatars0.githubusercontent.com/u/40733956?v=4" width="100px;" alt="Chrys Rakotonimanana"/><br /><sub><b>Chrys Rakotonimanana</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=chrys-elrak" title="Code">💻</a></td>
    <td align="center"><a href="https://cvjulien.netlify.com/"><img src="https://avatars0.githubusercontent.com/u/30557565?v=4" width="100px;" alt="Jul"/><br /><sub><b>Jul</b></sub></a><br /><a href="#projectManagement-julkwel" title="Project Management">📆</a> <a href="#review-julkwel" title="Reviewed Pull Requests">👀</a> <a href="https://github.com/julkwel/sekoliko/commits?author=julkwel" title="Tests">⚠️</a> <a href="https://github.com/julkwel/sekoliko/commits?author=julkwel" title="Code">💻</a></td>
    <td align="center"><a href="https://www.facebook.com/hantsaniala"><img src="https://avatars1.githubusercontent.com/u/8157490?v=4" width="100px;" alt="Hantsaniala Eléo"/><br /><sub><b>Hantsaniala Eléo</b></sub></a><br /><a href="#design-hantsaniala" title="Design">🎨</a></td>
  </tr>
  <tr>
    <td align="center"><a href="http://tolotrasmile.github.io"><img src="https://avatars3.githubusercontent.com/u/8298581?v=4" width="100px;" alt="Tolotra Raharison"/><br /><sub><b>Tolotra Raharison</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=tolotrasmile" title="Code">💻</a></td>
    <td align="center"><a href="https://github.com/vonyms"><img src="https://avatars3.githubusercontent.com/u/33556409?v=4" width="100px;" alt="Vony Randria"/><br /><sub><b>Vony Randria</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=vonyms" title="Code">💻</a></td>
    <td align="center"><a href="https://github.com/max5055"><img src="https://avatars1.githubusercontent.com/u/39415739?v=4" width="100px;" alt="rhianmax"/><br /><sub><b>rhianmax</b></sub></a><br /><a href="https://github.com/julkwel/sekoliko/commits?author=max5055" title="Code">💻</a></td>
    <td align="center"><a href="https://github.com/HenintsoaHARINORO"><img src="https://avatars2.githubusercontent.com/u/48785203?v=4" width="100px;" alt="Henintsoa Harinoro"/><br /><sub><b>Henintsoa Harinoro</b></sub></a><br /><a href="#translation-HenintsoaHARINORO" title="Translation">🌍</a></td>
  </tr>
</table>

<!-- ALL-CONTRIBUTORS-LIST:END -->

This project follows the [all-contributors](https://github.com/all-contributors/all-contributors) specification. Contributions of any kind welcome!
