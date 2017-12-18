jQuery(document).ready(function(){	

    jQuery('#generateRandomDate').click(function() {
        
        // Year
        var minYear = 2010;
        var maxYear = 2500;
        var year = Math.floor( Math.random() * ( maxYear - minYear + 1 ) + minYear );
        
        // Month
        var minMonth = 01;
        var maxMonth = 12;
        var month = Math.floor( Math.random() * ( maxMonth - minMonth + 1 ) + minMonth );
        
        // Day
        var minDay = 01;
        var maxDay;
        
        if ( jQuery.inArray( month, [01, 03, 05, 07, 08, 10, 12] ) )
        {
            maxDay = 31;
        }
        else if ( jQuery.inArray( month, [04, 06, 09, 11] ) )
        {
            maxDay = 30;
        }
        else if ( month == 02 ) {
            if ( ( year % 4 == 0 ) && ( year % 100 != 0 ) || ( year % 400 == 0 ) ) {
                maxDay = 29;
            }
            else {
                maxDay = 28;
            }
        }

        day = Math.floor( Math.random() * ( maxDay - minDay + 1 ) + minDay );
        
        // Set
        jQuery('#randomBirthdateYear').val(year);
        jQuery('#randomBirthdateMonth').val(month);
        jQuery('#randomBirthdateDay').val(day);
    });

});