
jQuery(function() {

	jQuery('.commune_Saisie').autocomplete({
		source: function( request, response ) {
			jQuery.ajax({
				url: "ajax/commune",
				dataType: "jsonp",
				data: {
					commune: PurgeAccent(jQuery('.commune_Saisie').val()),
					departement: ''
				},
				success: function( data ) {
					response( jQuery.map( data.communes, function( item ) {
						if (typeof item != "undefined"){
							return {
								label: item.commune +  " - " + (item.code_postal),
								value: item.commune,
								id: item.id,
								code_postal: item.code_postal
							}
						}
					}));
				},
				error: function(jqXHR, textStatus, errorThrown) {
				  // Une erreur s'est produite lors de la requete
				}
			});
		},
		minLength: 2,
		select: function( event, ui ) {
			jQuery('.commune_Saisie').val(ui.item.value);
			jQuery('.label_commune_Saisie').val(ui.item.value);
			jQuery('.id_commune_Saisie').val(ui.item.id);
			jQuery('.codepostal_Saisie').val(ui.item.code_postal);
		},
		open: function() {
			jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		}
	});

	jQuery('.niveauNo_Saisie').change(function() {
		var tab = jQuery('.niveauNo_Saisie').val().split('|');
		jQuery('.niveau_Saisie').val(tab[0]);
		jQuery('.particularite_Saisie').val(tab[1]);
		
		if(parseInt(tab[1]) == 0){
			jQuery('.container_autrefcpe').hide();
			jQuery('#nomautrefcpe_Saisie').val('');
		}else{
			jQuery('.container_autrefcpe').show();
		}
	});
		
	jQuery('.etablissementNo_Saisie').change(function() {
		var tab = jQuery('.etablissementNo_Saisie').val().split('|');
		jQuery('.id_etatnorma_Saisie').val(tab[0]);
		jQuery('.reference_Saisie').val(tab[1]);
		
		if (jQuery('.niveauNo_Saisie').length > 0){
			jQuery.ajax({
				url: "ajax/niveauadhesion",
				dataType: "jsonp",
				data: {
					reference: PurgeAccent(jQuery('.reference_Saisie').val())
				},
				success: function( data ) {
					
					jQuery('.niveauNo_Saisie').empty();
					// Ajout des nouveaux éléments de la liste.
					for (var i = 0; i < data.niveaux.length; i++) {
						jQuery('.niveauNo_Saisie').append('<option value="' + data.niveaux[i].id + '|' + data.niveaux[i].particularite + '">' + data.niveaux[i].libelle + ' - ' + data.niveaux[i].montant + '&euro;</option>');
					}
					
					var tab = jQuery('.niveauNo_Saisie').val().split('|');
					jQuery('.niveau_Saisie').val(tab[0]);
					jQuery('.particularite_Saisie').val(tab[1]);
					
					if(parseInt(tab[1]) == 0){
						jQuery('.container_autrefcpe').hide();
						jQuery('#nomautrefcpe_Saisie').val('');
					}else{
						jQuery('.container_autrefcpe').show();
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
				  // Une erreur s'est produite lors de la requete
				}
			});
		}
	});

	jQuery('.departement_Saisie').change(function() {
		jQuery.ajax({
			url: "ajax/etablissement",
			dataType: "jsonp",
			data: {
				etablissement: '',
				etatbal: etatBal,
				departement: jQuery('#departement_Saisie').val()
			},
			success: function( data ) {

				jQuery('.etablissementNo_Saisie').empty();
				
				// Ajout des nouveaux éléments de la liste.
				for (var i = 0; i < data.etablissements.length; i++) {
					jQuery('.etablissementNo_Saisie').append('<option value="' + data.etablissements[i].id + '|' + data.etablissements[i].lien + '">' + data.etablissements[i].nom + ' - ' + data.etablissements[i].code_postal + ' ' + data.etablissements[i].commune + '</option>');
				}
				
				var tab = jQuery('.etablissementNo_Saisie').val().split('|');
				jQuery('.id_etatnorma_Saisie').val(tab[0]);
				jQuery('.reference_Saisie').val(tab[1]);
				jQuery('.niveauNo_Saisie').empty();
				
				if (jQuery('.niveauNo_Saisie').length > 0){
					jQuery.ajax({
						url: "ajax/niveauadhesion",
						dataType: "jsonp",
						data: {
							reference: PurgeAccent(jQuery('.reference_Saisie').val())
						},
						success: function( data ) {
							
							jQuery('.niveauNo_Saisie').empty();
							// Ajout des nouveaux éléments de la liste.
							for (var i = 0; i < data.niveaux.length; i++) {
								jQuery('.niveauNo_Saisie').append('<option value="' + data.niveaux[i].id + '|' + data.niveaux[i].particularite + '">' + data.niveaux[i].libelle + ' - ' + data.niveaux[i].montant + '&euro;</option>');
							}
							
							var tab = jQuery('.niveauNo_Saisie').val().split('|');
							jQuery('.niveau_Saisie').val(tab[0]);
							jQuery('.particularite_Saisie').val(tab[1]);
							
							if(parseInt(tab[1]) == 0){
								jQuery('.container_autrefcpe').hide();
								jQuery('#nomautrefcpe_Saisie').val('');
							}else{
								jQuery('.container_autrefcpe').show();
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
						  // Une erreur s'est produite lors de la requete
						}
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  // Une erreur s'est produite lors de la requete
			}
		});
	});
	
	
	jQuery('#classe_Saisie').change(function() {
		jQuery.ajax({
			url: "ajax/classe",
			dataType: "jsonp",
			data: {
				classe: jQuery('#classe_Saisie').val()
			},
			success: function( data ) {
				if (data.exploration == 1)
				{
					jQuery('#exploration').show();
				}
				else
				{
					jQuery('#exploration').hide();
					jQuery('#exploration1_Saisie option[value=""]').prop('selected', true);
					jQuery('#exploration2_Saisie option[value=""]').prop('selected', true);
					jQuery('#exploration3_Saisie option[value=""]').prop('selected', true);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  // Une erreur s'est produite lors de la requete
			}
		});
	});
	
});