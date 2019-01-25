<?php 

              $piew ='<div id="news_ticker">
                        <span class="news_ticker">ALERT SCHEDULER</span>
                          <ul class="news_ticker" >';
                     
                        
              $piew .=   '</ul>
                    </div>'; 
              $piew .='<style type="text/css">
                    #news_ticker {
                        background: -moz-linear-gradient(center top , #1e5f8f, #3496df) repeat-x scroll 0 0 rgba(0, 0, 0, 0);
                        width: 100%;
                        height: 27px;
                        overflow: hidden;
                        -webkit-border-radius: 4px;
                        -moz-border-radius: 4px;
                        border-radius: 4px;
                        padding: 3px;
                        position: relative;
                       
                        -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                        box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                    } 
                    span.news_ticker{
                        float: left;
                        color: rgba(0,0,0,.8);
                        color: #fff;
                        
                        padding: 6px;
                        position: relative;
                        border-radius: 4px;
                        font-size: 12px;
                        -webkit-box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2), 0px 1px 1px rgba(0,0,0,0.5);
                       
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#004b67", endColorstr="#003548",GradientType=0 );
                    }

                    ul.news_ticker{
                        float: left;
                        padding-left: 20px;
                        -webkit-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -moz-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -ms-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                    }
                    ul.news_ticker:hover {
                        -webkit-animation-play-state: paused;
                        -moz-animation-play-state: paused;
                        -ms-animation-play-state: paused;
                        animation-play-state: paused;
                    }
                    li.news_ticker {line-height: 26px;}
                    #news_ticker span.isi {
                        color: #fff;
                        text-decoration: none;
                        font-size: 13px;
                    }

                    @-webkit-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-moz-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-ms-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                      </style>';
       
              echo $piew
    
?>