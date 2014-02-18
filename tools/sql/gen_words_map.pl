#!/usr/bin/perl
# generate words mapping 


use strict;

use utf8;
use open ":encoding(utf8)"; 

while(<>){
    chomp;
    my @words = split /\s+/, $_;

    my $head = shift @words;

    my $uppper_case = uc (substr $head, 0, 1 );

#    print "uppper_case: $uppper_case\n";
    
    for my $one ( @words ){
#        $one = Encode::encode_utf8($one);
        for( my $index = 0; $index < length $one; $index++ ){
            
            my $letter = substr $one, $index,1;
        
            print "'$letter' => '$uppper_case', \n";
        }
        

    }

}