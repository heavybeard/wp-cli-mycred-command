# wp-cli-mycred-command

myCRED commands for WP-CLI

https://it.wordpress.org/plugins/mycred/

`wp mycred` is a WP-CLI command that enables you to manage myCRED Wordpress plugin.

---

## Requires

* WP-CLI 0.23 or later

---

## Getting Started

```bash
$ wp package install heavybeard/wp-cli-mycred-command:@stable
```

---


## Subcommands

### Export Points Log

* `export` - Create a csv file with points log

```bash
$ wp mycred export <output-file> [--user_id=<user_id>] [--number=<number>] [--order_by=<order_by>] [--order=<order>]
```

### Help

```bash
$ wp help mycred

NAME

  wp mycred

DESCRIPTION

  Implements myCRED plugin commands.

SYNOPSIS

  wp mycred <command>

SUBCOMMANDS
  export      Export myCRED log points in a csv file.
```

## Installing manually

```bash
$ mkdir -p ~/.wp-cli/commands && cd -
$ git clone git@github.com:heavybeard/wp-cli-mycred-command.git
```

Add following into your `~/.wp-cli/config.yml`.

```yaml
require:
  - commands/wp-cli-mycred-command/commands.php
```

## Upgrade

```
$ wp package update
```
