<?php

require __DIR__ . '/vendor/autoload.php';

// instanciation du client
$api = \Datatourisme\Api\DatatourismeApi::create('http://localhost:9999/blazegraph/namespace/kb/sparql');
// éxecution d'une requête
$rdftype="https://www.datatourisme.gouv.fr/ontology/core#Hotel";
$var='
{
  poi(
    filters: [
      {
        rdf_type:  {_eq:"'.$rdftype.'"} 
      }
    ]
    size:10
   )
  {  
    total  
    results {                 
      rdfs_label
      hasDescription {
        shortDescription    
      } 
      hasArchitecturalStyle{
        rdfs_label
      }
      providesCuisineOfType{
        rdfs_label
      }
      isEquippedWith{
        rdfs_label
      }
      hasTheme{
        rdfs_label
      }
      hasContact{
        foaf_homepage
        schema_telephone
        schema_email
      }
      offers{
        schema_acceptedPaymentMethod{
          rdfs_label
        }
      }
      hasReview{
        hasReviewValue {
          rdfs_label
        }
      }
      isLocatedAt {
        schema_address {
          schema_addressLocality
        }
        schema_geo{
          schema_latitude   # <- Latitude du POI
          schema_longitude  # <- Longitude du POI
        }
      } 
    }
  }
}';
//echo $var;

$result = $api->process($var);
// prévisualisation des résultats

echo json_encode($result);

/*highlight_string("<?php\n\$result =\n" . var_export($result, true) . ";\n?>");*/

?>