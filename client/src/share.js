export default function Share(purl, ptitle, pimg, text) {
    'use strict';
    this.purl = purl;
    this.ptitle = ptitle;
    this.pimg = pimg;
    this.text = text;

    this.vk = function () {
        var url  = 'http://vk.com/share.php?';
        if (this.purl) {
            url += 'url=' + encodeURIComponent(this.purl);
        }
        if (this.ptitle) {
            url += '&title=' + encodeURIComponent(this.ptitle);
        }
        if (this.pimg) {
            url += '&image=' + encodeURIComponent(this.pimg);
        }
        url += '&noparse=true';
        this.popup(url);
    };

    this.fb = function () {
        var url  = 'http://www.fb.com/sharer.php?s=100';
        if (this.ptitle) {
            url += '&p[title]='     + encodeURIComponent(this.ptitle);
        }
        if (this.text) {
            url += '&p[summary]='   + encodeURIComponent(this.text);
        }
        if (this.purl) {
            url += '&p[url]='       + encodeURIComponent(this.purl);
        }
        if (this.pimg) {
            url += '&p[images][0]=' + encodeURIComponent(this.pimg);
        }
        this.popup(url);
    };

    this.tw = function () {
        var url = "https://twitter.com/intent/tweet?",
            MAX_LEN_TW = 140,
            content = this.ptitle,
            site_url = this.purl,
            index = MAX_LEN_TW;
        while ((content + site_url).length > MAX_LEN_TW) {
            index = content.lastIndexOf(' ', index - 1);
            if (index !== -1 && index - 4 - site_url.length <= MAX_LEN_TW) {
                content = content.slice(0, index);
                content += '... ';
            } else if (index === -1) {
                content = '';
            }
        }
        if (this.purl) {
            url += "original_referer=" + encodeURIComponent(this.purl);
        }
        if (this.ptitle) {
            url += "&text=" + encodeURIComponent(content);
        }
        url += "&tw_p=tweetbutton";
        if (this.purl) {
            url += "&url=" + encodeURIComponent(site_url);
        }
        this.popup(url);
    };

    this.popup = function (url) {
        window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
    };
}