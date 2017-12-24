require('./home')
require('./bootstrap');
require('./stripe_helper');

window.view = $('meta[name=view]').attr("content");

require('./includes/marketing/register');
