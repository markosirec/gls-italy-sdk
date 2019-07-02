<?php

namespace GlsItaly\Tests;

use PHPUnit\Framework\TestCase;
use MarkoSirec\GlsItaly\SDK\Adapters\ParcelAdapter as ParcelAdapter;
use MarkoSirec\GlsItaly\SDK\Models\Parcel as Parcel;
use MarkoSirec\GlsItaly\SDK\Models\Auth as Auth;
use MarkoSirec\GlsItaly\SDK\Adapters\RequestData as RequestData;

class ParcelAdapterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\ValidationException
     */
    public function testMissingDataValidation(): void
    {
        $parcel = new Parcel();
        $parcelAdapter = new ParcelAdapter($this->getAuth(), $parcel);
        $this->assertEquals(true, $parcelAdapter->get());
    }

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\ValidationException
     */
    public function testMissingNameValidation(): void
    {
        $parcel = new Parcel();

        $parcel->setAddress('Test street, 191');
        $parcel->setCity('SOS ALINOS');
        $parcel->setPostcode('08028');
        $parcel->setProvince('NU');

        $parcelAdapter = new ParcelAdapter($this->getAuth(), $parcel);
        $this->assertEquals(true, $parcelAdapter->get());
    }

    public function testValidationSuccess(): void
    {
        $parcel = new Parcel();

        $parcel->setName('John Smith');
        $parcel->setAddress('Test street, 191');
        $parcel->setCity('SOS ALINOS');
        $parcel->setPostcode('08028');
        $parcel->setProvince('NU');
        $parcel->setWeight('2,7');

        $parcelAdapter = new ParcelAdapter($this->getAuth(), $parcel);
        $this->assertInstanceOf(RequestData::class, $parcelAdapter->get());
    }

    public function testConvertStatus(): void
    {
        $this->assertEquals(
            'waiting',
            ParcelAdapter::convertStatus('IN ATTESA DI CHIUSURA.')
        );
        
        $this->assertEquals(
            'closed',
            ParcelAdapter::convertStatus('CHIUSA.')
        );
    }

    public function testParseList(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <ListParcel>
              <Parcel>
                <Data>25/06/2019 15:43</Data>
                <NumSpedizione>590734654</NumSpedizione>
                <RiferimentiCliente />
                <Ddt>1234564</Ddt>
                <DenominazioneDestinatario>John Smith</DenominazioneDestinatario>
                <CittaDestinatario>SOS ALINOS</CittaDestinatario>
                <ProvinciaDestinatario>NU</ProvinciaDestinatario>
                <IndirizzoDestinatario>Via su vrangone, 191</IndirizzoDestinatario>
                <TotaleColli>2</TotaleColli>
                <PesoSpedizione>5,4</PesoSpedizione>
                <StatoSpedizione>IN ATTESA DI CHIUSURA.</StatoSpedizione>
              </Parcel>
            </ListParcel>';

        $this->assertEquals(
            1,
            count(ParcelAdapter::parseListResponse($xml))
        );
    }

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\AddParcelException
     */
    public function testParseAddResponseMissingParcelNumber(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <InfoLabel>
                <Parcel>
                </Parcel>
            </InfoLabel>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseAddResponse($xml)
        );
    }

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\AddParcelException
     */
    public function testParseAddResponseErrorParcelNumber(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <InfoLabel>
                <Parcel>
                    <NumeroSpedizione>999999999</NumeroSpedizione>
                </Parcel>
            </InfoLabel>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseAddResponse($xml)
        );
    }

    public function testParseAddResponseGetParcelId(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <InfoLabel>
                <Parcel>
                    <NumeroSpedizione>123</NumeroSpedizione>
                </Parcel>
            </InfoLabel>';

        $response = ParcelAdapter::parseAddResponse($xml);

        $this->assertEquals(
            123,
            $response->getParcelId()
        );
    }

    public function testParseAddResponseGetPdf(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <InfoLabel>
                <Parcel>
                    <NumeroSpedizione>123</NumeroSpedizione>
                    <PdfLabel>foo</PdfLabel>
                </Parcel>
            </InfoLabel>';

        $response = ParcelAdapter::parseAddResponse($xml);

        $this->assertEquals(
            'foo',
            $response->getPdfLabel()
        );
    }

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\CloseParcelException
     */
    public function testParseCloseResponseError(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <DescrizioneErrore>foo</DescrizioneErrore>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseCloseResponse($xml)
        );
    }

    public function testParseCloseResponse(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <DescrizioneErrore>OK</DescrizioneErrore>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseCloseResponse($xml)
        );
    }

    public function testParseDeleteResponse(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <DescrizioneErrore>Eliminazione della spedizione 123 avvenuta.</DescrizioneErrore>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseDeleteResponse($xml, 123)
        );
    }

    /**
     * @expectedException MarkoSirec\GlsItaly\SDK\Exceptions\DeleteParcelException
     */
    public function testParseDeleteResponseError(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <DescrizioneErrore>Spedizione 123 non presente.</DescrizioneErrore>';

        $this->assertEquals(
            true,
            ParcelAdapter::parseDeleteResponse($xml, 123)
        );
    }

    private function getAuth(): Auth
    {
        $auth = new Auth();
        $auth->setBranchId('1');
        $auth->setClientId('1');
        $auth->setPassword('1');
        $auth->setContractId('1');
        return $auth;
    }
}
