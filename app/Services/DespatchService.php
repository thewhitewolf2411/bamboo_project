<?php

namespace App\Services;

use App\Eloquent\Despatch\DespatchedDevice;
use Carbon\Carbon;

class DespatchService {

    private $single_order = [
        "orderReference" => null,
        "recipient" => [
            "address" => [
                "fullName" => null,
                "companyName" => null,
                "addressLine1" => null,
                "addressLine2" => null,
                "addressLine3" => null,
                "city" => null,
                "county" => null,
                "postcode" => null,
                "countryCode" => null
            ],
            "phoneNumber" => null,
            "emailAddress" => null,
            "addressBookReference" => null
        ],
        "sender" => [
            "tradingName" => "Bamboo Distribution",
            "phoneNumber" => "061061061",
            "emailAddress" => "info@bamboodistribution.com",
        ],
        "billing" => [
            "address" => [
                "fullName" => null,
                "companyName" => null,
                "addressLine1" => null,
                "addressLine2" => null,
                "addressLine3" => null,
                "city" => null,
                "county" => null,
                "postcode" => null,
                "countryCode" => null
            ],
            "phoneNumber" => "061061061",
            "emailAddress" => "test@live.com"
        ],
        "packages" => [
            0 => [
                "weightInGrams" => 1,
                "packageFormatIdentifier" => "undefined",
                "customPackageFormatIdentifier" => "string",
                "dimensions" => [
                    "heightInMms" => 1,
                    "widthInMms" => 1,
                    "depthInMms" => 1,
                ],
                "contents" => [
                    0 => [
                        "name" => "Something",
                        "SKU" => "Something",
                        "quantity" => 1,
                        "unitValue" => 0,
                        "unitWeightInGrams" => 0,
                        "customsDescription" => "description",
                        "extendedCustomsDescription" => "extended",
                        "customsCode" => "123456",
                        "originCountryCode" => "UK",
                        "customsDeclarationCategory" => "none",
                        "requiresExportLicence" => true
                    ]
                ]
            ]
        ],
        "orderDate" => null, // 2019-08-24T14:15:22Z
        "plannedDespatchDate" => null,
        "specialInstructions" => null,
        "subtotal" => 0,
        "shippingCostCharged" => 0,
        "otherCosts" => 0,
        "total" => 0,
        "currencyCode" => "GBP",
        "postageDetails" => [
            "sendNotificationsTo" => "sender",
            "serviceCode" => null,
            "serviceRegisterCode" => "st",
            "consequentialLoss" => 0,
            "receiveEmailNotification" => true,
            "receiveSmsNotification" => true,
            "guaranteedSaturdayDelivery" => true,
            "requestSignatureUponDelivery" => true,
            "isLocalCollect" => false,
            "isDeliveryDutyPaid" => true,
            "safePlace" => "something",
            "department" => "something",
            "AIRNumber" => "test",
            "requiresExportLicense" => true,
            "commercialInvoiceNumber" => "test",
            "commercialInvoiceDate" => "2019-08-24T14:15:22Z"
        ],
        // "tags" => [
        //     0 => [
        //         "key" => "test",
        //         "value" => "test"
        //     ]
        // ]
        "label" => [
            "includeLabelInResponse" => true,
            "includeCN" => true,
            "includeReturnsLabel" => true,
        ]
    ];

    /**
     * Despatch devices to RM CD API.
     */
    public function despatchDevices($tradeins){

        $json_data = ['items' => []];
        foreach($tradeins as $tradein){

            $customer = $tradein->customer();
            $fullname = $tradein->customerName();
            $orderDate = Carbon::now()->toIso8601ZuluString();

            $customer_address = $customer->delivery_address;
            $splitted = explode(', ', $customer_address);
            $city = $splitted[count($splitted) - 2];
            $address = $splitted[count($splitted) - 3];
            $country = 'United Kingdom';
            $postcode = $splitted[count($splitted) - 1];
            $countryCode = 'UK';

            $customer_billing_address = $customer->billing_address;
            $splitted_billing = explode(', ', $customer_billing_address);
            $city_billing = $splitted[count($splitted_billing) - 2];
            $address_billing = $splitted[count($splitted_billing) - 3];
            $country_billing = 'United Kingdom';
            $postcode_billing = $splitted[count($splitted_billing) - 1];
            $countryCode_billing = 'UK';
            
            $orderReference =  "ORDER " . $tradein->barcode;
            $tradein->tracking_reference =  $orderReference;
        
            $order = [
                "orderReference" => $orderReference,
                "recipient" => [
                    "address" => [
                        "fullName" => $fullname,
                        "companyName" => "Bamboo Mobile",
                        "addressLine1" => $address,
                        "addressLine2" => null,
                        "addressLine3" => null,
                        "city" => $city,
                        "county" => $country,
                        "postcode" => $postcode,
                        "countryCode" => $countryCode
                    ],
                    "phoneNumber" => $customer->contact_number,
                    "emailAddress" => $customer->email,
                    "addressBookReference" => null
                ],
                "sender" => [
                    "tradingName" => "Bamboo Distribution",
                    "phoneNumber" => "061061061",
                    "emailAddress" => "info@bamboodistribution.com",
                ],
                "billing" => [
                    "address" => [
                        "fullName" => $fullname,
                        "companyName" => null,
                        "addressLine1" => $address_billing,
                        "addressLine2" => null,
                        "addressLine3" => null,
                        "city" => $city_billing,
                        "county" => $country_billing,
                        "postcode" => $postcode_billing,
                        "countryCode" => $countryCode_billing
                    ],
                    "phoneNumber" => $customer->contact_number,
                    "emailAddress" => $customer->email,
                ],
                "packages" => [
                    0 => [
                        "weightInGrams" => 1,
                        "packageFormatIdentifier" => "undefined",
                        "customPackageFormatIdentifier" => "string",
                        "dimensions" => [
                            "heightInMms" => 1,
                            "widthInMms" => 1,
                            "depthInMms" => 1,
                        ],
                        "contents" => [
                            0 => [
                                "name" => $tradein->getProductName($tradein->id),
                                "SKU" => "Something",
                                "quantity" => 1,
                                "unitValue" => 0,
                                "unitWeightInGrams" => 0,
                                "customsDescription" => null,
                                "extendedCustomsDescription" => "extended",
                                "customsCode" => "123456",
                                "originCountryCode" => $countryCode,
                                "customsDeclarationCategory" => "none",
                                "requiresExportLicence" => true
                            ]
                        ]
                    ]
                ],
                "orderDate" => $orderDate,      // 2019-08-24T14:15:22Z
                "plannedDespatchDate" => null,
                "specialInstructions" => null,
                "subtotal" => 0,                // subtotal price
                "shippingCostCharged" => 0,     // shipping costs charged
                "otherCosts" => 0,              // other costs
                "total" => 0,                   // total price
                "currencyCode" => "GBP",
                "postageDetails" => [
                    "sendNotificationsTo" => "sender",
                    "serviceCode" => null,
                    "serviceRegisterCode" => "st",
                    "consequentialLoss" => 0,
                    "receiveEmailNotification" => true,
                    "receiveSmsNotification" => true,
                    "guaranteedSaturdayDelivery" => true,
                    "requestSignatureUponDelivery" => true,
                    "isLocalCollect" => false,
                    "isDeliveryDutyPaid" => true,
                    "safePlace" => null,
                    "department" => null,
                    "AIRNumber" => "test",
                    "requiresExportLicense" => true,
                    "commercialInvoiceNumber" => $tradein->barcode,
                    "commercialInvoiceDate" => $orderDate
                ],
                // "tags" => [
                //     0 => [
                //         "key" => "test",
                //         "value" => "test"
                //     ]
                // ]
                "label" => [
                    "includeLabelInResponse" => false,      // true - caused errors (1 label max)
                    "includeCN" => true,
                    "includeReturnsLabel" => true,
                ]
            ];

            array_push($json_data['items'], $order);
        }

        $ch = curl_init( "https://api.parcel.royalmail.com/api/v1/orders" );
        $payload = json_encode($json_data);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization: ' . env('CD_AUTH')
        ));

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result,true);
        $success_msg = [];
        $error_msg = [];

        if($response['successCount'] > 0){
            $created_orders = $response['createdOrders'];
            foreach($created_orders as $created_order){
                foreach($tradeins as $tradein){
                    // save tradein tracking reference
                    if($tradein->tracking_reference === $created_order['orderReference']){
                        $tradein->job_state = '21';
                        $tradein->save();
                        array_push($success_msg, 'Tradein ' . $tradein->barcode . ' despached successfully.');
                        
                        DespatchedDevice::create([
                            'tradein_id' => $tradein->id,
                            'order_identifier' => $created_order['orderIdentifier'],
                            'order_reference'=> $created_order['orderReference'], 
                            'order_date' => $created_order['orderDate']
                        ]);
                    }
                }
            }
        }
        if($response['errorsCount'] > 0){
            foreach($response['failedOrders'] as $failed_order_data){

                $failed_order = $failed_order_data['order'];
                foreach($tradeins as $tradein){
                    if($tradein->tracking_reference === $failed_order['orderReference']){
                        $tradein->tracking_reference = null;
                        $tradein->save();
                    }
                }

                foreach($failed_order_data['errors'] as $error){
                    $error_fields = [];
                    foreach($error['fields'] as $field){
                        array_push($error_fields, $field['fieldName']);
                    }
                    $failed_fields = "";
                    if(count($error_fields) > 1){
                        $failed_fields = implode(', ', $error_fields);
                    } else {
                        $failed_fields = $error_fields[0];
                    }
                    $error_message = $error['errorMessage'] . ' ['. $failed_fields . ']';
                    array_push($error_msg, $error_message);
                }
            }

        }

        return [
            'success' => $success_msg,
            'error' => $error_msg
        ];
    }

}