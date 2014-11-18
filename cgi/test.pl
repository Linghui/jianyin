#!/usr/bin/perl

use strict;
use CGI;
use LWP::UserAgent;

print "Content-type:text/html\n\n";

my $newua = LWP::UserAgent->new;
my $response = $newua->get('http://www.jian-yin.com/cgi/51.pl');

print $response->status_line;
print "\n";

my $content = $response->decoded_content;

print $content;
print "\n";