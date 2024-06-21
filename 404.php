<?php


get_header(); ?>
<style>
/*======================
    404 page
=======================*/


.flex-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    color: white;
    animation: colorSlide 15s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;

    .text-center {
        text-align: center;

        h1,
        h3 {
            margin: 10px;
            cursor: default;

            .fade-in {
                animation: fadeIn 2s ease infinite;
            }
        }

        h3 {
            margin-bottom: 24px;
        }

        h1 {
            font-size: 8em;
            transition: font-size 200ms ease-in-out;
            border-bottom: 1px dashed white;

            span#digit1 {
                animation-delay: 200ms;
            }

            span#digit2 {
                animation-delay: 300ms;
            }

            span#digit3 {
                animation-delay: 400ms;
            }
        }

        @media(max-width: 600px) {
            h1 {
                font-size: 4em;
            }
        }
    }
}
</style>
<div class="flex-container">
    <div class="text-center">
        <h1>
            <span class="fade-in" id="digit1">4</span>
            <span class="fade-in" id="digit2">0</span>
            <span class="fade-in" id="digit3">4</span>
        </h1>
        <h3 class="fadeIn">PAGE NOT FOUND</h3>
        <a href="/" class="primary-button"><span>Return To Home</span></a>
    </div>
</div>

<?php get_footer(); ?>