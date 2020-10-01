#!/usr/bin/perl

use warnings;
use strict;
use File::Find;
use File::Basename;
use File::Path qw(make_path);

my @thumbnailable_extensions = qw(
pdf
);

my $timestart = time;

my $home_path = '/home/thundergoblin';
@ARGV = ("$home_path/b.robnugen.com/pdf") unless @ARGV;

my ($num_exist, $num_to_create) = (0, 0);

my @curlOutput;
my @rmOutput;
my @rrmOutput;  # remote rm

sub urlifyFileName {
    my ($sourceImagePath) = @_;
    # create a URL for the image
    $sourceImagePath =~ s|$home_path|https:/|;
    # get the filename (works for paths with /) thanks https://stackoverflow.com/a/35838395/194309
    my $final_filename = (split '/', $sourceImagePath)[-1];
    return "curl $sourceImagePath > $final_filename";
}

sub rmFileName {
    my ($osImagePath) = @_;
    return "rm $osImagePath";
}

sub rrmFileName {
    my ($osImagePath) = @_;
    return "ssh b.rn '" . rmFileName($osImagePath) . "'";
}

sub processFiles {

    # check if the file is an image file that we'd like to thumbnail
    my $pattern_match_extensions = '(\d){8}_(\d){6}_[a-z|A-Z]+_(\d){6,10}\.('.join('|',@thumbnailable_extensions).')';

    if ( basename($File::Find::name) =~ /($pattern_match_extensions)\Z/i ) {
	push(@curlOutput, urlifyFileName($File::Find::name) . "\n");
	push(@rmOutput,rmFileName($File::Find::name) . "\n");
	push(@rrmOutput,rrmFileName($File::Find::name) . "\n");
    }
}

find(\&processFiles, @ARGV);
print @curlOutput;
print @rmOutput;
print @rrmOutput;

my $duration = time - $timestart;
print "Execution time: $duration s\n";
