$('#dodajForm').submit(function(){ 
    event.preventDefault(); 
    console.log("Dodavanje"); 
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea'); 

    const serijalizacija = $form.serialize(); 
    console.log(serijalizacija); 

    $input.prop('disabled', true);

    req = $.ajax({  
        url: 'handler/dodajKnjigu.php',
        type:'post',
        data: serijalizacija 
    });

    req.done(function(res, textStatus, jqXHR){ 
        if(res=="Success"){ 
            alert("Kolokvijum uspešno zakazan");
            console.log("Dodat kolokvijum");
            location.reload(true); 
        }else console.log("Kolokvijum nije dodat "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){ 
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

$('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    req = $.ajax({ 
        url: 'handler/izmeniKnjigu.php',
        type:'post',
        data: serializedData
    });

    req.done(function(res, textStatus, jqXHR){ 
        if(res=="Success"){ 
            alert("Knjiga je uspesno izmenjena!");
            console.log("Knjiga izmenjena.");
            location.reload(true); 
        }else console.log("Knjiga nije uspesno izmenjena "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){ 
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
});

    $('#izbrisiForm').submit(function () {
        event.preventDefault();
        console.log("Brisanje");
        const $form = $(this);
        const $inputs = $form.find('input, select, button, textarea');
        const serializedData = $form.serialize();
        console.log(serializedData);
        $inputs.prop('disabled', true);
    
        req = $.ajax({ 
            url: 'handler/iznajmiKnjigu.php',
            type:'post',
            data: serializedData
        });
    
        req.done(function(res, textStatus, jqXHR){ 
            if(res=="Success"){ 
                alert("Knjiga je uspesno iznajmljena!");
                console.log("Knjiga iznajmljena.");
                location.reload(true); 
            }else console.log("Knjiga nije uspesno iznajmljena "+res);
            console.log(res);
        });
    
        req.fail(function(jqXHR, textStatus, errorThrown){ 
            console.error('Sledeca greska se desila> '+textStatus, errorThrown)
        });

});
