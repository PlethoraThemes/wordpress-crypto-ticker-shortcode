<?php

function cryptotickerCreate( $atts ) {

  $atts = shortcode_atts(
    array( 'currency' => 'EUR' ),
    $atts
  );

  $coinmarketcapAPI = "https://api.coinmarketcap.com/v2/ticker/1/?convert=" . $atts['currency'];
  $response = wp_remote_get( $coinmarketcapAPI );
  $body = $response['body']; 
  $body = json_decode($body);

  $content = '<div class="text-center"><p class="btn btn-primary"><i class="fa fa-btc"></i> BitCoin Price</p><br/>';

  foreach ( $body->data->quotes as $key => $value) {
    $content .= '<p class="btn btn-secondary">' . $key . ': <i class="fa fa-' . strtolower($key) . '"></i> ' . floor($value->price) . '</p>';
  }

  $content .= '</div>';

  return $content;

}
add_shortcode( 'cryptoticker', 'cryptotickerCreate' );