# SuperSort

_...a super-duper sorting function for your Craft CMS templates._

**A [Top Shelf Craft](https://topshelfcraft.com) creation**  
[Michael Rog](https://michaelrog.com), Proprietor


* * *


## What is SuperSort?

The **SuperSort** plugin provides a powerful Twig filter that helps with ordering an array of values &mdash; either using one of PHP's built-in methods to sort the actual values, or using custom "sort as" methods to arrange the array based on the rendered results of processing each member as a Twig object template.

Using **SuperSort**'s "sort as" methods, you can sort an array of elements by any accessible object value &mdash; including values from Matrix blocks, attributes of related elements, math calculations, etc.


## Usage

### Installation

Visit the _Plugin Store_ in your Craft control panel, search for **SuperSort**, and click to _Install_ the plugin.

Or, if you're feeling frisky, you can install **SuperSort** via [Composer](https://getcomposer.org/):

    composer require topshelfcraft/supersort

### General usage

Use the `supersort` filter to sort an array of objects.

(You can apply `supersort` to any array or *ElementQuery*. A non-array-like source will be converted into an empty array... which probably isn't very useful for sorting.)


### Basic Sorting

The first parameter of the filter specifies the sort method.

    {% set sortedSource = source | supersort('asort') %}

You can use any of [PHP's built-in sort methods](http://php.net/manual/en/array.sorting.php):

- [`'asort'`](http://php.net/manual/en/function.asort.php)
- [`'arsort'`](http://php.net/manual/en/function.arsort.php)
- [`'ksort'`](http://php.net/manual/en/function.ksort.php)
- [`'krsort'`](http://php.net/manual/en/function.krsort.php)
- [`'natsort'`](http://php.net/manual/en/function.natsort.php)
- [`'natcasesort'`](http://php.net/manual/en/function.natcasesort.php)
- [`'sort'`](http://php.net/manual/en/function.sort.php)
- [`'rsort'`](http://php.net/manual/en/function.rsort.php)
- [`'shuffle'`](http://php.net/manual/en/function.shuffle.php)

If you don't supply this first parameter, a plain vanilla `asort` will be applied:

    {% set sortedSource = source | supersort %}
    
In many common cases &mdash; such as when you're sorting names, numbers, or filenames &mdash; the default `'asort'` algorithm may produce unwanted results. In those cases, consider using the case-insensitive natural sorting algorithm ([`'natcasesort'`](http://php.net/manual/en/function.natcasesort.php)).


### Advanced ("As") Sorting

You can also sort by one of **SuperSort**'s custom methods:

- `'sortAs'`
- `'rsortAs'`
- `'natsortAs'`
- `'natcasesortAs'`

To use these methods, you will provide a second parameter, which is a Twig object template to [render](https://docs.craftcms.com/api/v3/craft-web-view.html#renderObjectTemplate()-detail) using each object in the array:

    {% set upcomingEvents = upcomingEvents | supersort('sortAs', '{eventDates.first.date}') %}

    {% set upcomingEvents = upcomingEvents | supersort('sortAs', '{{ object.eventDates.first.date }}') %}

(This "object template" syntax is the same as you might use to define a [Dynamic Subfolder Path](http://buildwithcraft.com/docs/assets-fields#dynamic-subfolder-paths) for an Assets field.


### Sort Flags

You can optionally provide a third parameter &mdash; one of PHP's [sort flags](http://php.net/manual/en/function.sort.php).

    {% set source = source | supersort('sortAs', '{foo}', SORT_NUMERIC) %}

    {% set source = source | supersort('asort', null, SORT_NUMERIC) %}

If you don't supply this third parameter, the default (`SORT_REGULAR`) flag is used.


### Using SuperSort as a PHP helper

If you'd like to use the `superSort()` method as a helper in another Craft plugin or component, you can access it in PHP directly from the Sorter service:

```php
$result = Sorter::superSort($array, $method, $as, $sortFlag);
``` 

(Note: [PHP's built-in sort methods](http://php.net/manual/en/array.sorting.php) sort an array in place and return a _boolean_ representing success. The `superSort()` method, by contrast, returns the result _array_.)

* * *


## Support

### What are the system requirements?

Craft 3.0+ and PHP 7.0+


### I found a bug.

Nah...


### I triple-checked. It's a bug.

Well, alright. Please open a GitHub Issue, submit a PR to the `3.x.dev` branch, or just email me to let me know.


* * *

#### Contributors:

 - Plugin development: [Michael Rog](https://michaelrog.com) / @michaelrog
 - Craft 3 port: [TJ Draper](https://buzzingpixel.com) / @tjdraperpro
 - Icon: [Ralf Schmitzer](https://dribbble.com/schmitzer), via [The Noun Project](https://thenounproject.com/term/sort/503379)
