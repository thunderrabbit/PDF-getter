#!/usr/bin/perl

use warnings;
use strict;
use File::Find;
use File::Basename;
use File::Path qw(make_path);
use Image::Magick;

my $image = Image::Magick->new;

my @thumbnailable_extensions = qw(
.pdf
);

my $timestart = time;

my $home_path = '/home/thundergoblin';
@ARGV = ("$home_path/b.robnugen.com/pdf") unless @ARGV;

my ($num_exist, $num_to_create) = (0, 0);

sub urlifyFileName {
    my ($sourceImagePath) = @_;
    # create a URL for the image
    $sourceImagePath =~ s|$home_path|https:/|;
    print "$sourceImagePath\n";
}

sub processFiles {

    # check if the file is an image file that we'd like to thumbnail
    my $pattern_match_extensions = join('|',@thumbnailable_extensions);

    if ( basename($File::Find::name) =~ /($pattern_match_extensions)\Z/i ) {
	urlifyFileName($File::Find::name);
    }
}

find(\&processFiles, @ARGV);

print "$num_exist thumbnails existed, and $num_to_create needed to be created\n";

print "Copy the above URLs into emacs and do C-c ! on them.\n\n";

my $duration = time - $timestart;
print "Execution time: $duration s\n";
