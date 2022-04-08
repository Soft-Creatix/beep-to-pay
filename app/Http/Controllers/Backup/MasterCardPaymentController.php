<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Mastercard\Developer\OAuth\Utils\AuthenticationUtils;
use Mastercard\Developer\OAuth\OAuth;
use Mastercard\Developer\Signers\CurlRequestSigner;
use Mastercard\Developer\Encryption;
use Mastercard\Developer\Encryption\FieldLevelEncryption;
use Mastercard\Developer\Encryption\FieldLevelEncryptionConfigBuilder;
use Mastercard\Developer\Encryption\FieldValueEncoding;
use Mastercard\Developer\Utils\EncryptionUtils;

class PaymentController extends Controller
{
    public function authHeaderGenerator() {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );

        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/tokenize';
        $method = 'POST';
        $payload = '';

        $authHeader = OAuth::getAuthorizationHeader($uri, $method, $payload, $consumerKey, $signingKey);

        return response()->json(['data' => $authHeader]);
    }

    public function encryptData() {

        $payload = '{
            "responseHost": "site1.your-server.com",
            "requestId": "123456",
            "tokenType": "CLOUD",
            "tokenRequestorId": "98765432101",
            "taskId": "123456",
            "fundingAccountInfo": {
              "encryptedPayload": {
                "publicKeyFingerprint": "243E6992EA467F1CBB9973FACFCC3BF17B5CD007",
                "encryptedKey": "A1B2C3D4E5F6112233445566",
                "oaepHashingAlgorithm": "SHA512",
                "iv": "NA",
                "encryptedData": {
                  "cardAccountData": {
                    "accountNumber": "5123456789012345",
                    "expiryMonth": "09",
                    "expiryYear": "21",
                    "securityCode": "123"
                  },
                  "accountHolderData": {
                    "accountHolderAddress": {
                      "line1": "100 1st Street",
                      "line2": "Apt. 4B",
                      "city": "St. Louis",
                      "countrySubdivision": "MO",
                      "postalCode": "61000",
                      "country": "USA"
                    },
                    "accountHolderMobilePhoneNumber": {
                      "countryDialInCode": "44",
                      "phoneNumber": "07777 777 777"
                    }
                  },
                  "source": "ACCOUNT_ON_FILE"
                }
              }
            },
            "consumerLanguage": "en",
            "tokenizationAuthenticationValue": "RHVtbXkgYmFzZSA2NCBkYXRhIC0gdGhpcyBpcyBub3QgYSByZWFsIFRBViBleGFtcGxl",
            "decisioningData": {
              "recommendation": "APPROVED",
              "recommendationAlgorithmVersion": "01",
              "deviceScore": "1",
              "accountScore": "1",
              "recommendationReasons": [
                "LONG_ACCOUNT_TENURE"
              ],
              "deviceCurrentLocation": "38.63,-90.25",
              "deviceIpAddress": "127.0.0.1",
              "mobileNumberSuffix": 3456
            }
        }';

        $encryptionCertificate = EncryptionUtils::loadEncryptionCertificate(
            'https://static.developer.mastercard.com/content/mdes-digital-enablement/sbx-keys/Public-Key-Encrypt.crt'
        );

        $decryptionKey = EncryptionUtils::loadDecryptionKey(
            'https://static.developer.mastercard.com/content/mdes-digital-enablement/sbx-keys/Private-Key-Decrypt.pem'
        );

        $fieldLevelEncryptionConfig = FieldLevelEncryptionConfigBuilder::aFieldLevelEncryptionConfig()
            ->withEncryptionPath('$.fundingAccountInfo.encryptedPayload.encryptedData', '$.fundingAccountInfo.encryptedPayload')
            ->withDecryptionPath('$.tokenDetail', '$.tokenDetail.encryptedData')
            ->withDecryptionPath('$.encryptedPayload', '$.encryptedPayload.encryptedData')
            ->withEncryptionCertificate($encryptionCertificate)
            ->withDecryptionKey($decryptionKey)
            ->withOaepPaddingDigestAlgorithm('SHA-512')
            ->withEncryptedValueFieldName('encryptedData')
            ->withEncryptedKeyFieldName('encryptedKey')
            ->withIvFieldName('iv')
            ->withOaepPaddingDigestAlgorithmFieldName('oaepHashingAlgorithm')
            ->withEncryptionCertificateFingerprintFieldName('publicKeyFingerprint')
            ->withFieldValueEncoding(FieldValueEncoding::HEX)
            ->build();

        $encryptedPayload = FieldLevelEncryption::encryptPayload($payload, $fieldLevelEncryptionConfig);
        $decryptPayload = FieldLevelEncryption::decryptPayload($encryptedPayload, $fieldLevelEncryptionConfig);

        return (json_encode(json_decode($encryptedPayload), JSON_PRETTY_PRINT));
    }

    public function tokenize(Request $request) {

        $payload = '{
            "responseHost": "site1.your-server.com",
            "requestId": "123456",
            "tokenType": "CLOUD",
            "tokenRequestorId": "98765432101",
            "taskId": "123456",
            "fundingAccountInfo": {
              "encryptedPayload": {
                "publicKeyFingerprint": "243E6992EA467F1CBB9973FACFCC3BF17B5CD007",
                "encryptedKey": "A1B2C3D4E5F6112233445566",
                "oaepHashingAlgorithm": "SHA512",
                "iv": "NA",
                "encryptedData": {
                  "cardAccountData": {
                    "accountNumber": "5123456789012345",
                    "expiryMonth": "09",
                    "expiryYear": "21",
                    "securityCode": "123"
                  },
                  "accountHolderData": {
                    "accountHolderAddress": {
                      "line1": "100 1st Street",
                      "line2": "Apt. 4B",
                      "city": "St. Louis",
                      "countrySubdivision": "MO",
                      "postalCode": "61000",
                      "country": "USA"
                    },
                    "accountHolderMobilePhoneNumber": {
                      "countryDialInCode": "44",
                      "phoneNumber": "07777 777 777"
                    }
                  },
                  "source": "ACCOUNT_ON_FILE"
                }
              }
            },
            "consumerLanguage": "en",
            "tokenizationAuthenticationValue": "RHVtbXkgYmFzZSA2NCBkYXRhIC0gdGhpcyBpcyBub3QgYSByZWFsIFRBViBleGFtcGxl",
            "decisioningData": {
              "recommendation": "APPROVED",
              "recommendationAlgorithmVersion": "01",
              "deviceScore": "1",
              "accountScore": "1",
              "recommendationReasons": [
                "LONG_ACCOUNT_TENURE"
              ],
              "deviceCurrentLocation": "38.63,-90.25",
              "deviceIpAddress": "127.0.0.1",
              "mobileNumberSuffix": "92"
            }
        }';
        // $payloadJSON = json_decode($payload, true);

        $encryptionCertificate = EncryptionUtils::loadEncryptionCertificate(
            'https://static.developer.mastercard.com/content/mdes-digital-enablement/sbx-keys/Public-Key-Encrypt.crt'
        );

        $decryptionKey = EncryptionUtils::loadDecryptionKey(
            'https://static.developer.mastercard.com/content/mdes-digital-enablement/sbx-keys/Private-Key-Decrypt.pem'
        );

        $fieldLevelEncryptionConfig = FieldLevelEncryptionConfigBuilder::aFieldLevelEncryptionConfig()
            ->withEncryptionPath('$.fundingAccountInfo.encryptedPayload.encryptedData', '$.fundingAccountInfo.encryptedPayload')
            ->withDecryptionPath('$.tokenDetail', '$.tokenDetail.encryptedData')
            ->withDecryptionPath('$.encryptedPayload', '$.encryptedPayload.encryptedData')
            ->withEncryptionCertificate($encryptionCertificate)
            ->withDecryptionKey($decryptionKey)
            ->withOaepPaddingDigestAlgorithm('SHA-512')
            ->withEncryptedValueFieldName('encryptedData')
            ->withEncryptedKeyFieldName('encryptedKey')
            ->withIvFieldName('iv')
            ->withOaepPaddingDigestAlgorithmFieldName('oaepHashingAlgorithm')
            ->withEncryptionCertificateFingerprintFieldName('publicKeyFingerprint')
            ->withFieldValueEncoding(FieldValueEncoding::HEX)
            ->build();

        $encryptedPayload = FieldLevelEncryption::encryptPayload($payload, $fieldLevelEncryptionConfig);

        $api = new TokenizeApi($this->client, $this->config);
        $request = self::buildTokenizeRequestSchema();
        $response = $api->createTokenize($request);
        // $payload = $encryptedPayload;

        // $method = 'POST';
        // $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/tokenize';
        // $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        // $signingKey = AuthenticationUtils::loadSigningKey(
        //     $keypath,
        //     'keyalias',
        //     'keystorepassword'
        // );
        // $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        // $headers = array(
        //     'Content-Type: application/json',
        //     'Content-Length: ' . strlen($payload)
        // );

        // $handle = curl_init($uri);
        // curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        // $signer = new CurlRequestSigner($consumerKey, $signingKey);
        // $signer->sign($handle, $method, $headers, $payload);
        // $result = curl_exec($handle);
        // curl_close($handle);

        return $result;
    }

    public function notifyTokenUpdated(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/notifyTokenUpdated';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "encryptedPayload": {
              "publicKeyFingerprint": "243E6992EA467F1CBB9973FACFCC3BF17B5CD007",
              "encryptedKey": "A1B2C3D4E5F6112233445566",
              "oaepHashingAlgorithm": "SHA512",
              "iv": "NA",
              "encryptedData": {
                "tokens": [
                  {
                    "tokenUniqueReference": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
                    "tokenRequestorId": "98765432101",
                    "status": "SUSPENDED",
                    "eventReasonCode": "SUSPECTED_FRAUD",
                    "suspendedBy": [
                      "CARDHOLDER"
                    ],
                    "productConfig": {
                      "brandLogoAssetId": "800200c9-629d-11e3-949a-0739d27e5a66",
                      "issuerLogoAssetId": "dbc55444-986a-4896-b41c-5d5e2dd431e2",
                      "isCoBranded": true,
                      "coBrandName": "Co brand partner",
                      "coBrandLogoAssetId": "dbc55444-496a-4896-b41c-5d5e2dd431e2",
                      "cardBackgroundCombinedAssetId": "739d27e5-629d-11e3-949a-0800200c9a66",
                      "cardBackgroundAssetId": "456d27e5-629d-11e3-949a-0800200c9a66",
                      "iconAssetId": "739d87e5-629d-11e3-949a-0800200c9a66",
                      "foregroundColor": 0,
                      "issuerName": "Issuing Bank",
                      "shortDescription": "Bank Rewards MasterCard",
                      "longDescription": "Bank Rewards MasterCard with the super duper rewards program",
                      "customerServiceUrl": "https://bank.com/customerservice",
                      "customerServiceEmail": "customerservice@bank.com",
                      "customerServicePhoneNumber": 1234567891,
                      "issuerMobileApp": null,
                      "onlineBankingLoginUrl": "bank.com",
                      "termsAndConditionsUrl": "https://bank.com/termsAndConditions",
                      "privacyPolicyUrl": "https://bank.com/privacy",
                      "issuerProductConfigCode": 123456
                    },
                    "tokenInfo": {
                      "tokenPanSuffix": "0001",
                      "accountPanPrefix": "500000",
                      "accountPanSuffix": "0011",
                      "tokenExpiry": 921,
                      "accountPanExpiry": 921,
                      "dsrpCapable": true,
                      "tokenAssuranceLevel": 3,
                      "productCategory": "CREDIT"
                    }
                  }
                ]
              }
            }
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function transact(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/remotetransaction/static/1/0/transact';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "tokenUniqueReference": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
            "dsrpType": "UCAF",
            "unpredictableNumber": 23424563
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function getAsset() {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'GET';
        $baseUri = 'https://sandbox.api.mastercard.com/mdes/assets/static/1/0/asset/{ASSET_ID}';

        // $queryParams = array('param1' => 'with spaces', 'param2' => 'encoded#symbol');
        // $uri = $baseUri . '?' . http_build_query($queryParams);
        // $handle = curl_init($uri);

        $handle = curl_init($baseUri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function suspend(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/suspend';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "paymentAppInstanceId": 123456789,
            "tokenUniqueReferences": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
            "causedBy": "CARDHOLDER",
            "reason": "Lost/stolen device",
            "reasonCode": "SUSPECTED_FRAUD"
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function unSuspend(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/unsuspend';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "paymentAppInstanceId": 123456789,
            "tokenUniqueReferences": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
            "causedBy": "CARDHOLDER",
            "reason": "Lost/stolen device",
            "reasonCode": "SUSPECTED_FRAUD"
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function delete(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/delete';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "paymentAppInstanceId": 123456789,
            "tokenUniqueReferences": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
            "causedBy": "CARDHOLDER",
            "reason": "Lost/stolen device",
            "reasonCode": "SUSPECTED_FRAUD"
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function getTaskStatus(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/getTaskStatus';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "tokenRequestorId": 98765432101,
            "taskId": 123456
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function searchTokens(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/searchTokens';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "requestId": 123456,
            "responseHost": "site2.payment-app-provider.com",
            "fundingAccountInfo": {
              "encryptedPayload": {
                "publicKeyFingerprint": "243E6992EA467F1CBB9973FACFCC3BF17B5CD007",
                "encryptedKey": "A1B2C3D4E5F6112233445566",
                "oaepHashingAlgorithm": "SHA512",
                "iv": "NA",
                "encryptedData": {
                  "cardAccountData": {
                    "accountNumber": "5123456789012345",
                    "expiryMonth": "09",
                    "expiryYear": "21",
                    "securityCode": "123"
                  },
                  "accountHolderData": {
                    "accountHolderAddress": {
                      "line1": "100 1st Street",
                      "line2": "Apt. 4B",
                      "city": "St. Louis",
                      "countrySubdivision": "MO",
                      "postalCode": "61000",
                      "country": "USA"
                    },
                    "accountHolderMobilePhoneNumber": {
                      "countryDialInCode": "44",
                      "phoneNumber": "07777 777 777"
                    }
                  },
                  "source": "ACCOUNT_ON_FILE"
                }
              }
            },
            "tokenRequestorId": 98765432101
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }

    public function getToken(Request $request) {
        $keypath = 'https://beeptopay.codigostudios.co.uk/BeepToPay-sandbox.p12';
        $signingKey = AuthenticationUtils::loadSigningKey(
            $keypath,
            'keyalias',
            'keystorepassword'
        );
        $consumerKey = 'wcGABOEtw1oO3wqvNEkx002GibdX_6J2XLb3KgfC75db922b!33a25f64f32f4961bee76ec8206dfd190000000000000000';

        $method = 'POST';
        $uri = 'https://sandbox.api.mastercard.com/mdes/digitization/static/1/0/getToken';
        // $payload = json_encode(['foo' => 'bår']);
        $payload = '{
            "responseHost": "site2.payment-app-provider.com",
            "requestId": 123456,
            "paymentAppInstanceId": 123456789,
            "tokenUniqueReference": "DWSPMC000000000132d72d4fcb2f4136a0532d3093ff1a45",
            "includeTokenDetail": true
        }';
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );
        $handle = curl_init($uri);
        curl_setopt_array($handle, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_POSTFIELDS => $payload));
        $signer = new CurlRequestSigner($consumerKey, $signingKey);
        $signer->sign($handle, $method, $headers, $payload);
        $result = curl_exec($handle);
        curl_close($handle);

        return $result;
    }


}
