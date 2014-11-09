#!/usr/bin/perl


use LWP::UserAgent;
use HTML::Parser ();
use Data::Dumper qw/Dumper/;
use URI::Escape;
use HTTP::Cookies;
use CGI::Carp qw(fatalsToBrowser);

use strict;


my $hidLangType;
my $hidAccessKey;
my $fksc;
my $hidEhireGuid;

my $ua = LWP::UserAgent->new;


#$ua->default_headers( $headers_obj );
my $headers_obj = $ua->default_headers;

$ua->default_header('Accept'=>'application/x-ms-application, image/jpeg, application/xaml+xml, image/gif, image/pjpeg, application/x-ms-xbap, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, application/x-shockwave-flash, */*');
$ua->default_header('Accept-Language' => 'en-US');
$ua->default_header('Accept-Encoding'=>'gzip, deflate');
$ua->default_header('Connection'=>'Keep-Alive');
$ua->agent('Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E)');

#my $request = HTTP::Request->new(GET =>'http://ehire.51job.com/MainLogin.aspx');

#$ua->proxy(['http', 'https'], 'http://127.0.0.1:8888/');

print "Content-type:text/html\n\n";

#my $cookie_base = $ENV{HOME};
my $cookie_base = "/tmp/51";
$ua->cookie_jar(HTTP::Cookies->new(file => $cookie_base."/51_cookies.txt", ignore_discard => 1));

&get_para();

my $para = {

    "ctmName" => uri_escape("中广互联") ,
    "userName" => "zghl863",
    "password" => "cnjobs2014",
    "checkCode" => "",
    "oldAccessKey" => "$hidAccessKey",
    "isRememberMe" => "true",
    "langtype" => $hidLangType,
    "sc" => "$fksc",
    "ec" => "$hidEhireGuid"
};

#$request = HTTP::Request->new(POST =>'http://ehire.51job.com/Member/UserLogin.aspx');
$ua->default_header('Referer'=>'http://ehire.51job.com/MainLogin.aspx');
$ua->default_header("Cache-Control" => 'no-cache');
    
#my $response = $ua->post('http://www.kuaidot.com/d', Content => $para);
my $response = $ua->post('http://ehire.51job.com/Member/UserLogin.aspx', Content => $para);

$ua->cookie_jar->extract_cookies($response);
$ua->cookie_jar->save();
my $jump_href;
print "1\n";
print $response->decoded_content."\n";

&parser_jump($response->decoded_content);
print "$jump_href\n";
if( $jump_href =~ /UserOffline/){
    
    $response = $ua->post($jump_href);
} else {
    $response = $ua->get($jump_href);
}

print "response\n";
print $response->decoded_content;

$ua->cookie_jar->extract_cookies($response);
print "cookie : " . $ua->cookie_jar->as_string;

$ua->cookie_jar->save("$cookie_base/51_loggedin_cookies.txt");

#open WRT, ">".$ENV{HOME}."/51_loggedin_cookies.txt" or die "open error";
#print "#LWP-Cookies-1.0\n";
#print WRT $ua->cookie_jar->as_string;
#close WRT;
#print "\n";

sub parser_jump(){
    my $html = shift;
    
    my $p = HTML::Parser->new( api_version => 3,
        start_h => [\&jump_start, "tagname, attr"],
        end_h   => [\&jump_end,   "tagname"],
        marked_sections => 1,
    );
    
    $p->parse($html);
    
}


sub jump_start()
{
    my ( $tag, $attr, $dtext, $origtext ) = @_;
    print "tag $tag\n";
    if ( $tag =~ /^a$/ )
    {
        if($attr-> {'href'}){
            $jump_href = $attr-> {'href'};
            return;
        }
    }
}
sub jump_end(){

}

sub get_para(){
    my $p = HTML::Parser->new( api_version => 3,
        start_h => [\&start, "tagname, attr"],
        end_h   => [\&end,   "tagname"],
        marked_sections => 1,
    );


    my $response = $ua->get('http://ehire.51job.com/MainLogin.aspx');

    #if($response -> is_sccuess){
    #    print $response->decoded_content;
    #}

    $p->parse($response->decoded_content);

    print "hidLangType $hidLangType";
    print "\n";

    print "hidAccessKey $hidAccessKey";
    print "\n";

    print "fksc $fksc";
    print "\n";

    print "hidEhireGuid $hidEhireGuid";
    print "\n";
}

sub start
{
    my ( $tag, $attr, $dtext, $origtext ) = @_;

    if ( $tag =~ /^input$/ )
    {
        if($attr-> {'type'} ne 'hidden'){
            return;
        }

        if (  $attr ->{'id'} eq 'hidLangType' )
        {
            $hidLangType = $attr->{'value'};
            
        }
        if ( $attr ->{'id'} eq 'hidAccessKey' )
        {
            $hidAccessKey = $attr->{'value'};
        

        }
        if ( $attr ->{'id'} eq 'fksc' )
        {
            $fksc = $attr->{'value'};
            

        }
        if ( $attr ->{'id'} eq 'hidEhireGuid' )
        {
            $hidEhireGuid = $attr->{'value'};

        }
    }
}

sub end(){
    
}



