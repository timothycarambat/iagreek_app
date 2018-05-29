require('./bootstrap');

import fontawesome from '@fortawesome/fontawesome'
import regular from '@fortawesome/fontawesome-free-regular'
import solid from '@fortawesome/fontawesome-free-solid'

fontawesome.library.add(regular)
fontawesome.library.add(solid)


require('./includes/bootstrap-checkbox-radio');
require('./includes/bootstrap-notify');
require('./includes/chartist.min');
require('./includes/demo');
require('./includes/paper-dashboard');
require('./stripe_helper');
require('jquery-simple-upload');
require('./includes/notify');


window.view = $('meta[name=view]').attr("content");
window.csrf_token = $('meta[name="csrf-token"]').attr('content');

require('./profile');
