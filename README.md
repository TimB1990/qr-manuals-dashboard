## description
<p> This project runs Vue.js in the frontend, with a Laravel 6 backend</p>
<p> This project is an alpha, current version: 1.0.1 </p>

## test login data
Email: admin@unfolded.nl, 
Password admin

## database
the database dump file is optional. It may not work because PDF files may not be included with the package, or due to passport issues.
Therefore it is recommended (in case you just want test data) to run php artisan migrate:refresh --seed. The database will then be populated

## Issues & temporary bugs
<p><strong>Known issues</strong><p>
<ul>
    <li>Stock functionality productpage not yet implemented<li>
</ul>

<p><strong>Temporary Bugs</strong></p>
<b>no responsive layout</b>

## note
<p>The most recent version is on branch 'V2'. Make sure you pull from this branche</p>

## installation
<code>composer update</code>
<code> npm i </code>
<code>php artisan passport:install --force</code>
<code> php artisan migrate:refresh --seed </code>

## serve on laravel's localhost
<code> php artisan serve</code>



