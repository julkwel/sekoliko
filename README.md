# Sekoliko Application

Based on Symfony 4.0

## Contribution Setup

- Fork this repository in your branch

- Clone and run `composer install --prefer-dist`

- Configure your database connection in `.env`

- import DataBase in `data/dump/`

- All Class Name is in `StudlyCaps` and have a prefix as `Sk`

- All method name is in `camelCase` prefix not required

- All html class have a separated with `-` ex `class="my-class"`

- Add a documentation in your code

## GIT

- Commit message must with `git commit -m "(action ? add : edit : delete : update) : file edit or your big modification`

- Send your PR in develop branch.

## TODOS

- Add import export data (csv) done on #24

- Add chart in dashboard

- Add url security

- Log activities (logs)

- Add softdelete

- Ariary net integrations

## Import export data

To import student data go to /admin/classe/ then click on student list /new student , Import etudiant via csv file , and format your csv like bellow :

| nom | prenom | email        | username | adresse | telephone |
| --- | ------ | ------------ | -------- | ------- | --------- |
| jul | jul    | jul1@jul.com | jul1     | jul     | 345475684 |
| jul | jul    | jul2@jul.com | jul2     | jul     | 345475684 |
| jul | jul    | jul3@jul.com | jul3     | jul     | 345475684 |
| jul | jul    | jul4@jul.com | jul4     | jul     | 345475684 |
|     |        |              |          |         |           |

## Front

- Run `npm install` to install all dependencies

- Run `npm run watch` to watch your changes.

- Todo
  - Hot reload feature to improve _Developer Experience_
  - Add tests.

_Made for all Malagasy kids !!!_
