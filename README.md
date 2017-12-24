# SuperSort

_A super-duper sorting filter for your Craft CMS templates_

by Michael Rog  
[https://topshelfcraft.com](https://topshelfcraft.com)



## What is SuperSort?

The **SuperSort** plugin provides a powerful Twig filter for ordering an array of values - either using one of PHP's built-in methods to sort the actual values, or using custom "sort as" methods to arrange the array based on the rendered results of running each member through a Twig object template.

Using **SuperSort**'s "sort as" methods, you can sort an array of elements by any accessible object value &mdash; including values from Matrix blocks, attributes of related elements, math calculations, etc.


## Usage

### Installation

`composer require topshelfcraft/supersort`

### General usage

Use the `supersort` filter to sort an array of objects.

(You can apply `supersort` to any array or *ElementCriteriaModel*. A non-array-like source will be converted into an empty array... which probably isn't very useful for sorting.)


### Basic Sorting

The first parameter of the filter specifies the sort method.

    {% set sortedSource = source | supersort('asort') %}

You can use any of PHP's built-in sort methods:

- `'asort'`
- `'arsort'`
- `'ksort'`
- `'krsort'`
- `'natsort'`
- `'natcasesort'`
- `'sort'`
- `'rsort'`
- `'shuffle'`

If you don't supply this first parameter, a plain vanilla `asort` will be applied:

    {% set sortedSource = source | supersort %}


### Advanced Sorting

You can also sort by one of **SuperSort**'s custom methods:

- `'sortAs'`
- `'rsortAs'`
- `'natsortAs'`
- `'natcasesortAs'`

To use these methods, you will provide a second parameter, which is a Twig object template to [render](https://craftcms.com/classreference/services/TemplatesService#renderObjectTemplate-detail) using each object in the array:

    {% upcomingEvents | supersort('sortAs', '{eventDates.first.date}') %}

    {% upcomingEvents | supersort('sortAs', '{{ object.eventDates.first.date }}') %}

You can construct an object template using the same syntax as you might use to define a [Dynamic Subfolder Path](http://buildwithcraft.com/docs/assets-fields#dynamic-subfolder-paths) for an Assets field.


### Sort Flags

You can optionally provide a third parameter &mdash; one of PHP's [sort flags](http://php.net/manual/en/function.sort.php).

    {% source | supersort('sortAs', '{foo}', SORT_NUMERIC) %}

    {% source | supersort('asort', false, SORT_NUMERIC) %}

If you don't supply this third parameter, the default (`SORT_REGULAR`) flag is used.


### What are the system requirements?

Craft 3.0+ and PHP 7.0+


### I found a bug.

Nah...


### I triple-checked. It's a bug.

Well, alright. Please open a GitHub Issue, submit a PR to the `dev` branch, or just email me to let me know.


* * *

#### Contributors:

 - Plugin development: [Michael Rog](http://michaelrog.com) / @michaelrog
 - Icon: [Ralf Schmitzer](https://dribbble.com/schmitzer), via [The Noun Project](https://thenounproject.com/term/sort/503379)
