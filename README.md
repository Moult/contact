# vlibrary

vlibrary is a minimal jumpstart for small BDD library development with PHPSpec
and Phing.

## vlibrary-dci

The DCI branch provides useful tool interfaces and exception classes when
developing in a DCI environment.

Be sure to prune what you don't need during the project, check the license
definition (default is MIT), and change the namespace.

These tool interfaces are fully supported by the Kohana-based driver module
provided with vtemplate, but are essentially framework agnostic.

# Get started immediately

To begin a fresh project with vlibrary, create your new git repository as usual,
then follow these instructions within your repository's root to get started.

1. `git remote add -f vlibrary git://github.com/Moult/vlibrary.git`
2. `git merge -Xtheirs vlibrary/dci`
3. Delete the readme contents up to the `Development` section.

# Development

1. Get [Composer](http://getcomposer.org) `curl -s
   http://getcomposer.org/installer | php` and then run `php composer.phar
   install --dev`. This is needed to set up testing tools (installs into
   `bin/`).
2. Use [Phing](http://www.phing.info/) to run `phing all` in project root. This
   will run `phpspec`, `phpcs`, `pdepend`, `phpmd`, `phpcpd`, `phpdcd`
   and `phpdoc2`. `phing` by itself is a shorthand to run just PHPSpec. For more
   information, see `phing -projecthelp`
3. Start developing. Specs are in `spec/`, documentation is in `docs/`. Any
   build logs generated by `phing all-log` useful for CI can be found in
   `build/`.
