#!/usr/bin/perl


use LWP::UserAgent;
use HTML::Parser ();
use Data::Dumper qw/Dumper/;
use URI::Escape;
use HTTP::Cookies;
use HTML::TreeBuilder;
use XML::Simple;
use JSON;
use CGI::Carp qw(fatalsToBrowser);
use CGI;

use utf8;
binmode(STDIN, ':encoding(utf8)');
binmode(STDOUT, ':encoding(utf8)');
binmode(STDERR, ':encoding(utf8)');


use strict;


my $hidLangType;
my $hidAccessKey;
my $fksc;
my $hidEhireGuid;


my $q = CGI->new;

my $key_word  = $q->param('keyword');
my $location_comman = $q->param('location');
my $location = $location_comman;
$location =~ s/,//g;
my $from_year = $q->param('from_year');
my $to_year = $q->param('to_year');

print "Content-type:text/html\n\n";

if(!defined($key_word) || !defined($location_comman) || !defined($from_year) || !defined($to_year) ){
    print "error : no ps";
    exit;
} else {
    print "$key_word ";
    print "$location_comman ";
    print "$location ";
    print "$from_year ";
    print "$to_year ";
    exit;
}


my $ua = LWP::UserAgent->new;

$ua->default_header('Accept'=>'application/x-ms-application, image/jpeg, application/xaml+xml, image/gif, image/pjpeg, application/x-ms-xbap, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/msword, application/x-shockwave-flash, */*');
$ua->default_header('Accept-Language' => 'en-US');
$ua->default_header('Accept-Encoding'=>'gzip, deflate');
$ua->default_header('Connection'=>'Keep-Alive');
$ua->default_header("Cache-Control" => 'no-cache');

$ua->agent('Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E)');

#$ua->proxy(['http', 'https'], 'http://127.0.0.1:8888/');

#my $key_word = 'android';
#my $from_year = '2';
#my $to_year = '5';
#my $location = '010100010200';
#my $location_comman = '010100,010200';

#my $cookie_base = $ENV{HOME};
my $cookie_base = "/tmp/51";
$ua->cookie_jar(HTTP::Cookies->new(file => "$cookie_base/51_loggedin_cookies.txt",ignore_discard => 1));
#$ua->cookie_jar->load($ENV{HOME}."/51_loggedin_cookies.txt");

my %cookie = &get_cookie($ua->cookie_jar->as_string);
$cookie{'guid'} = '14146466859464160050';
$cookie{'KWD'} = $key_word;
$cookie{'51job'} = 'cenglish%3D0';
my $cookie_str = "";
my $index = 0 ;
for my $key(keys %cookie){
    if($index == 0 ){
        $cookie_str .= $key ."=".$cookie{$key};
    } else {
        $cookie_str .= "; ".$key ."=".$cookie{$key};
    }
    $index++;
}
#print "$cookie_str\n";
$ua->default_header("Cookie" => $cookie_str);


my $para = {

    "MainMenuNew1\$CurMenuID" => "MainMenuNew1_imgResume|sub4" ,
    "txtUserID" => "--多个ID号用空格隔开--",
    "DpSearchList" => "",
    "WORKFUN1\$Text" => "最多只允许选择3个项目",
    'WORKFUN1$Value' => '',
    'KEYWORD' => $key_word,
    'AREA$Value' => $location_comman,
    'WorkYearFrom' => '0',
    'WorkYearTo' => '99',
    'TopDegreeFrom' => '',
    'TopDegreeTo' => '',
    'LASTMODIFYSEL' => '4',
    'WORKINDUSTRY1$Text' => '最多只允许选择3个项目',
    'WORKINDUSTRY1$Value' => '',
    'SEX' => '99',
    'JOBSTATUS' => '99',
    'hidSearchID' => '2,3,6,23,8,1,4,5,25,2,3,6,23,2,3,6,23,2,3,6,23',
    'hidWhere' => '00#0#0#0|99|20140908|20141108|99|99|'.$from_year.'|'.$to_year.'|99|000000|'.$location.'|99|99|99|0000|99|99|99|00|0000|99|99|99|0000|99|99|00|99|99|99|99|99|99|99|99|99|000000|0|0|0000#%BeginPage%#%EndPage%#'.$key_word,
    'hidValue' => 'KEYWORDTYPE#0*LASTMODIFYSEL#4*JOBSTATUS#99*WORKYEAR#'.$from_year.'|'.$to_year.'*SEX#99*AREA#'.$location_comman.'*TOPDEGREE#|*WORKINDUSTRY1#*WORKFUN1#*KEYWORD#'.$key_word,
    'hidTable' => '',
    'hidSearchNameID' => '',
    'hidPostBackFunType' => '',
    'hidChkedRelFunType' => '',
    'hidChkedExpectJobArea' => '',
    'hidChkedKeyWordType' => '0',
    'hidNeedRecommendFunType' => '',
    'hidIsFirstLoadJobDiv' => '1',
    'txtSearchName' => '',
    'ddlSendCycle' => '1',
    'ddlEndDate' => '7',
    'ddlSendNum' => '10',
    'txtSendEmail' => '',
    'txtJobName' => '',
    '__EVENTTARGET' => '',
    '__EVENTARGUMENT' => '',
    '__LASTFOCUS' => '',
    '__VIEWSTATE' => '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',
    
};

my $response = $ua->post('http://ehire.51job.com/Candidate/SearchResume.aspx', Content => $para);    
#my $response = $ua->post('http://www.kuaidot.com/d', Content => $para);
#http://ehire.51job.com/ajax/GlobalVerticalResumeDivAjax.aspx?doType=FetchResumeContent&SeqID=0&UserID=319554951&strKey=5f9aa136b84171a6&strLang=0
#$ua->cookie_jar->extract_cookies($response);

#open WRT, "> search.txt" or die "open error";
#print WRT $response->decoded_content;
#close WRT;

my @resumes = &grab_resume_info($response->decoded_content);

print to_json(\@resumes);

sub get_cookie(){
    my $cookie = shift;
    
    my %cookie = ();
    
    my @lines = split /\n/, $cookie;
    for my $line(@lines){
        my @pieces = split /:\s/, $line;
        my @sub_pieces = split /;\s/, $pieces[1];
        my @key_value = split /=/,$sub_pieces[0],2;
        $key_value[1] =~ s/\"//g;
        $cookie{$key_value[0]} = $key_value[1];
    }
    return %cookie;
}



# grab resume information out of search response page
sub grab_resume_info(){
    my $html = shift;
    
    my @resumes = ();
    
    my $root = new HTML::TreeBuilder;
    $root->parse($html);
    $root->eof();
    
    my $tbody;
    my @divs = $root->find_by_tag_name("div");
    
    for my $div(@divs){
        if($div->attr('id') eq  'divGridData'){

            $tbody = $div->find_by_tag_name("table");
            
        }
    }
    
    my @trs = $tbody->find_by_tag_name("tr");
    
    for my $tr(@trs){
        if($tr->attr('id') =~ /trBaseInfo_/){
            my %info_hash = ();
            my @tds = $tr->find_by_tag_name("td");

            for(my $index = 0; $index < scalar(@tds); $index++){
                my $td = $tds[$index];
                if( $index == 2){
                    my $a = $td ->find_by_tag_name("a");
                    $info_hash{'link'} = 'http://ehire.51job.com/'.$a->attr('href');
                    $info_hash{'id'} = $a->content->[0];
                    
                    
                    
                } elsif ($index == 3){
                    
                    $info_hash{'age'} = $td->content->[0];
                } elsif ($index == 4){
                    
                    $info_hash{'job_year'} = $td->content->[0];
                } elsif ($index == 5){
                    
                    $info_hash{'sex'} = $td->content->[0];
                } elsif ($index == 6){
                    
                    $info_hash{'location'} = $td->content->[0];
                } elsif ($index == 7){
                    if(defined($td->content)){
                        
                        $info_hash{'major'} = $td->content->[0];
                    } else {
                        
                        $info_hash{'major'} = "";
                    }
                } elsif ($index == 8){
                    
                    $info_hash{'degree'} = $td->content->[0];
                } elsif ($index == 9){
                    
                    $info_hash{'update_date'} = $td->content->[0];
                } elsif ($index == 10){
                    my $img = $td->find_by_tag_name("img");
                    my $detail = &grab_detail($img->attr('onclick'),$info_hash{'id'});
                    if(defined($detail)){
                        $info_hash{'keywords'} = $detail->{'keywords'};
                        $info_hash{'appraise'} = $detail->{'appraise'};
                        $info_hash{'workexplatest'} = $detail->{'workexplatest'};
                        $info_hash{'workexp'} = $detail->{'workexp'};
                        $info_hash{'addtype'} = $detail->{'addtype'};
                        $info_hash{'seqid'} = $detail->{'seqid'};
                    }
                }
            }
            push @resumes, \%info_hash;
        }
    }
    
    return @resumes;
}

sub grab_detail(){

    my $onclick_content = shift;
    my $id = shift;
    
    my @pieces = split /\',\'/, $onclick_content;
    
    my $link = 'http://ehire.51job.com/ajax/GlobalVerticalResumeDivAjax.aspx?doType=FetchResumeContent&SeqID=0&UserID='.$id.'&strKey='.$pieces[1].'&strLang=0';

    my $response = $ua->get($link); 
    if(defined($response->decoded_content)){
        return &parse_resume_xml($response->decoded_content);
    }
 
    return undef;
}

sub parse_resume_xml(){
    my $xml = shift;
    my $ref = XMLin($xml);
    return $ref;
}
