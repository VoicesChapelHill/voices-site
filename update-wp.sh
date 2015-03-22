#!/bin/sh

# This ensures that the wordpress subdirectory
# has a pristine copy of the version of wordpress
# from the file 'WORDPRESS.VERSION'

VERSION=$(cat WORDPRESS.VERSION)

# Get the tarball into the parent directory if we don't have it already
TARBALL=wordpress-4.1.1.tar.gz
if [ ! -f ../$TARBALL ] ; then
    wget -O ../$TARBALL https://wordpress.org/$TARBALL
fi

if [ -d wordpress ] ; then
  chmod -R a+w wordpress
  rm -rf wordpress
fi
tar xzf ../$TARBALL
chmod -R a+r wordpress
chmod -R a-w wordpress
