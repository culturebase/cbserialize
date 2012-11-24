# CbSerialize

CbSerialize is a collection of transformations which can be used to generate a
succinct and easily parsable "array tree" representation from a Propel object
hierarchy. An "array tree" is a tree of nested PHP arrays, which can either
represent dictionary-like objects or classic arrays, but no PHP objects. Such a
thing can be fed into [json_encode](http://php.net/json_encode) to produce a
deterministic and easily predictable JSON representation. In general the result
is simple enough to be easily encoded into a lot of different formats, but
powerful enough to represent all kinds of data you can possibly retrieve from a
PHP variable.

In contrast to Propel's toArray() methods the serializer does not automatically
transform all of the object tree so that you can avoid retrieving (and possibly
transmitting) data you won't actually need for the specific thing you're going
to do. Instead it prompts you to explicitly state the members you're going to
use.

For each node in the object tree you can define specific transformations. For
example you can do string or regexp replacement or change the keys under which
the node will show up in its parent node. There are a couple of predefined
transformations. You can easily add more by subclassing them.

In order to retrieve the values for the nodes, the serializer will prepend "get"
to each property you specify and call the resulting string as method on the
current object. You can specify parameters to be passed into that call. If the
result is again an object or an array the serializer will look for a
sub-serializer you may have specified to serialize that.

This technique has the disadvantage that it will create a lot of queries to the
database if you're serializing a deep object hierarchy. Make sure you use
Propel's join methods or populateRelation to avoid that.

## Example

Usage of the serializer is best shown by example. Suppose you have Propel object
$page representing a page in a website. That page object has a couple of
properties and a some other objects of type "Article" are referring to it. You
could serialize the page like this:

    $s = new CbPropelSerializer();
    CbPropelSerializer::objectToArray($page, array(
        "Id",
        "Type",
        "Label",
        "Description",
        "Visible",
        "InMenu"
        "UrlName" => $s->rename('Name'),
        "IdMediabox" => $s->rename('Mediabox'),
        "NumChildren" => $s->with_args(false),
        "Articles" => array(
            "Text",
            "Language"
        )
    ));

This might give you a result like this:

    array (
        'Id' => 144,
        'Type' => 'article',
        'Label' => 'workshops',
        'Description' => 'something about workshops',
        'Visible' => true,
        'InMenu' => true,
        'Name' => 'workshops',
        'Mediabox' => NULL,
        'NumChildren' => 0,
        'Articles' => array (
            array (
                'Text' => 'Text auf deutsch',
                'IdLanguage' => 1,
            ),
            array (
                'Text' => 'some text in english',
                'IdLanguage' => 2,
            )
        )
    )

## Roadmap

 1. There should also be a method to deserialize arrays into objects.
 2. It's probably not necessary to restrict this to Propel objects. We could as
    well serialize any object hierarchy where the properties are accesible with
    getFoo().